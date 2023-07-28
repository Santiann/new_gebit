<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Contrato;
use App\ContratoAnotacao;
use App\ContratoFinanceiro;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Auth;
use App\Usuario;
use App\Empresa;
use Illuminate\Support\Facades\Mail;
use App\Email;

class ParcelasEventSubscriber
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function enviaEmailPadraoView($view, $parametrosView, $deNome, $deEmail, $paraNome, $paraEmail, $assuntoEmail)
    {
        $view = $view??'sistema.email.aviso';
        $deNome = $deNome??'Dealix';
        $deEmail = $deEmail??'naoresponda@dealix.com.br';

        Mail::send($view,$parametrosView, function ($message) use($paraEmail, $assuntoEmail)
        {
            $message->to($paraEmail);
            $message->subject($assuntoEmail);
        });
        
        //Salvando na tabela de log de e-mail
        $requestData                    = array();
        $requestData['a997_de_nome']    = $deNome;
        $requestData['a997_de_email']   = $deEmail;
        $requestData['a997_para_nome']  = $paraNome;
        $requestData['a997_para_email'] = $paraEmail;
        $requestData['a997_assunto']    = $assuntoEmail;
        $requestData['a997_conteudo']   = $parametrosView['mensagem'];
        $cadastroEmail                  = Email::create($requestData);
    }

    function obterVencimento($fator){
        $data_base = mktime(0, 0, 0, 10, (07 + $fator), 1997);
        $vencimento = date("Y-m-d", $data_base);

        return $vencimento;
    }

    private function extrairDadosBoleto($path)
    {
        $parser = new \Smalot\PdfParser\Parser();
        $text   = $parser->parseFile($path)->getText();
        
        preg_match("/\d{5}\.\d{5} \d{5}\.\d{6} \d{5}\.\d{6} \d (\d{4})(\d{10})/", $text, $matches);
        
        if ($matches) {
            $vencimento = $matches[1] ? $this->obterVencimento($matches[1]) : null;
            $valor = $matches[2] ? substr_replace(ltrim($matches[2],0), '.', -2, 0) : null;

            return $valor && $vencimento ? compact('valor', 'vencimento') : false;
        }

        return false;
    }

    private function salvarBoleto($attachment, $id_contrato)
    {
        $filename = (string) time() . '.pdf';
        $path = "./storage/contratos/${id_contrato}/parcelas/";

        File::ensureDirectoryExists($path);

        $status = $attachment->save($path, $filename);

        return $path . $filename;
    }

    public function getEmailsLiberados($contrato)
    {
        $fornecedor_id = $contrato->a013_empresa_contratante == $contrato->a005_id_empresa ?
                                $contrato->a005_id_empresa_cli_for : $contrato->a005_id_empresa;

        $fornecedor = Empresa::find($fornecedor_id);

        $fornecedor_contatos = $fornecedor->Empresa_contato_hasMany->pluck('a006_email')->toArray();

        foreach ($fornecedor->Empresa_usuario_hasMany as $emp_user) {
            $fornecedor_emails[] = $emp_user->Usuario_belongsTo->a001_email;
        }

        return array_merge($fornecedor_contatos, $fornecedor_emails, [$fornecedor->a005_email]);
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handleNovaParcela($event)
    {
        $message = $event->message;
        $email_to = $message->getTo()->first()->mail;
        $from = $message->getFrom()->first();
       
        if ($message->hasAttachments() && strpos($email_to, '+')) 
        {
            $attachment = $message->getAttachments()->first();

            if ($attachment->getMimeType() === "application/pdf") 
            {
                $id_contrato = explode('@', explode('+', $email_to)[1])[0];

                $contrato = Contrato::find($id_contrato);
                $usuario = $contrato->Usuario_belongsTo;

                if (in_array($from->mail, $this->getEmailsLiberados($contrato)))
                {
                    $data['a028_documento'] = $this->salvarBoleto($attachment, $id_contrato);
                    $pdf_data = $this->extrairDadosBoleto($data['a028_documento']);

                    if ($pdf_data) {
                        $data['a013_id_contrato'] = $id_contrato;
                        $data['a005_id_empresa'] = $contrato->a005_id_empresa;
                        $data['a028_data_cobranca'] = $pdf_data['vencimento'];
                        $data['a028_valor_fracao'] = $pdf_data['valor'];
                        $data['a028_valor_comissao'] = 0;
                        $data['a028_valor_extra'] = 0;
                        $data['a028_status'] = 2;
                        $data['a028_created_by_email'] = $from->mail;
                        $data['a028_justificativa'] = "Nova parcela";
                        $data['a028_valor_total_contrato'] = $data['a028_valor_fracao'] + $data['a028_valor_comissao'] + $data['a028_valor_extra'];
                        
                        $new_financeiro = ContratoFinanceiro::create($data);
                        
                        $nome_empresa = $new_financeiro->Empresa_belongsTo->a005_nome_fantasia ?? $new_financeiro->Empresa_belongsTo->a005_razao_social ?? $new_financeiro->Empresa_belongsTo->a005_nome_completo;
                        $new_financeiro->nome_empresa = $nome_empresa;

                        // cria uma anotação de negociação pendente. Após aceitá-la, será possível mudar o status desta parcela
                        $anotacao = ContratoAnotacao::create([
                            'a013_id_contrato' => $id_contrato,
                            'a001_id_usuario' => $usuario->a001_id_usuario,
                            'a026_anotacao_titulo' => 'Nova parcela',
                            'a026_nome_usuario' => $usuario->a001_nome ." (".$usuario->a001_email.")",
                            'a026_anotacao_descricao' => "Nova parcela",
                            'a028_id_contrato_financeiro' => $new_financeiro->a028_id_contrato_financeiro,
                        ]);
                    }
                    else {
                        File::delete($data['a028_documento']);

                        $parametrosView['mensagem'] = 'Ocorreu um erro ao ler o boleto enviado para o contrato '.$id_contrato.'. Favor verificar se o arquivo está em formato PDF e permite leitura.';
                        
                        $this->enviaEmailPadraoView('sistema.email.aviso', $parametrosView, 'Dealix',
                            'naoresponda@dealix.com.br',$from->personal,$from->mail, 'Erro ao ler boleto');
                    }
                }
            }
        }
    }

     /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Webklex\IMAP\Events\MessageNewEvent',
            'App\Listeners\ParcelasEventSubscriber@handleNovaParcela'
        );
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 10/03/2020
 * Time: 11:06
 */

namespace App\Console\Commands;


use App\Cotacao;
use App\Cotacao_fornecedor;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\CotacaoController;
use App\Parametro;
use App\Contrato;
use App\Http\Controllers\Controller;
use Illuminate\Console\Command;
use Carbon\Carbon;

class cronNotificacao extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cronnotificacao:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia Email e notificação';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $dataAtual = Carbon::now()->format('Y-m-d');

        \Log::info("cronNotificacao Iniciou: $dataAtual");

        $controller = new Controller();

        $ParamDIASVENCIMENTOCONTRATO = Parametro::query()->where('a000_sigla', 'DIASVENCIMENTOCONTRATO')->first();
        $ParamTEXTOVENCIMENTOCONTRATO = Parametro::query()->where('a000_sigla', 'TEXTOVENCIMENTOCONTRATO')->first();
        $ParamCONTRATOVENCIDO = Parametro::query()->where('a000_sigla', 'CONTRATOVENCIDO')->first();
        $ParamTEXTOVENCIMENTODOCUMENTO = Parametro::query()->where('a000_sigla', 'TEXTOVENCIMENTODOCUMENTO')->first();

        $DiasVencimentoContrato = $controller->retiraCaracter($ParamDIASVENCIMENTOCONTRATO->a000_valor??'0');
        $dataLimiteVencimento = Carbon::now()->add('-'.$DiasVencimentoContrato, 'day');


        $contratoVencer = Contrato::query()
            ->join('t001_usuario','t001_usuario.a001_id_usuario','=','t013_contrato.a001_id_usuario')
            ->where('a013_data_fim' ,'>=', $dataAtual)///data de final tem que ser maior que hoje
            ->where('a013_data_fim' ,'<=', $dataLimiteVencimento->format('Y-m-d'))///data de final maior que essa data quer dizer que entrou no prazo de vencimento
            ->whereNotIn('a013_status',['V','D','C'])
            ->get();

        $contratoVenceHoje = Contrato::query()
            ->where('a013_data_fim' ,'=', $dataAtual)///data de final tem que ser = que hoje
            ->whereNotIn('a013_status',['V','D','C'])
            ->get();

        $contratoVencido = Contrato::query()
            ->where('a013_data_fim' ,'<', $dataAtual)///data de final tem que ser < que hoje
            ->whereNotIn('a013_status',['V','D','C'])
            ->get();


        $contratoVencer->map(function($row) use ($controller,$ParamTEXTOVENCIMENTOCONTRATO){
            $parametrosView['mensagem'] = $ParamTEXTOVENCIMENTOCONTRATO->a000_valor;
            $assunto = 'Contrato nº '.$contrato->a013_id_contrato.' em Prazo de Vencimento';
            $controller->enviaEmailPadraoView('sistema.email.aviso',$parametrosView,'Dealix','naoresponda@dealix.com.br',$row->a001_nome,$row->a001_email, $assunto);
            $controller->notificacaoPadrao(0,$row->a001_id_usuario,$assunto,$parametrosView['mensagem'],0, 'contrato');
        });
        $contratoVenceHoje->map(function($row) use ($controller,$ParamCONTRATOVENCIDO){
            $parametrosView['mensagem'] = $ParamCONTRATOVENCIDO->a000_valor;
            $assunto = 'Contrato nº '.$contrato->a013_id_contrato.' Vence Hoje';
            $controller->enviaEmailPadraoView('sistema.email.aviso',$parametrosView,'Dealix','naoresponda@dealix.com.br',$row->a001_nome,$row->a001_email, $assunto );
            $controller->notificacaoPadrao(0,$row->a001_id_usuario,$assunto,$parametrosView['mensagem'],0, 'contrato');
        });

        $contratoController = new ContratoController();
        $contratoVencido->map(function($row) use ($contratoController){
            $row->a013_status = 'V';
            $row->save();

            ///historico
            $contratoController->gravaHistorico($row);

        });


        //documentos do contrato
        $contrato = Contrato::query()
            ->join('t001_usuario','t001_usuario.a001_id_usuario','=','t013_contrato.a001_id_usuario')
            ->join('t014_contrato_documento','t014_contrato_documento.a013_id_contrato','=','t013_contrato.a013_id_contrato')
            ->join('t009_categoria_contrato_doc','t009_categoria_contrato_doc.a009_id_cat_contr_doc','=','t014_contrato_documento.a009_id_cat_contr_doc')
            ->where('a013_data_fim' ,'>=', $dataAtual)///data de final tem que ser maior que hoje
            ->where('a014_data_vencimento' ,'>=', $dataAtual)
            ->whereNotNull('a014_data_vencimento')
            ->whereNotIn('a013_status',['V','D','C'])
            ->get();


        $contrato->map(function($row) use ($controller,$ParamTEXTOVENCIMENTODOCUMENTO,$dataAtual){
            $a014_data_vencimento = $row->a014_data_vencimento;
            $a009_dias_alerta_vencimento = $row->a009_dias_alerta_vencimento;
            $dataLimiteVencimeto =  Carbon::now()->add('-'.$a009_dias_alerta_vencimento, 'day')->format('Y-m-d');
            //\Log::info("cronNotificacao : $dataLimiteVencimeto");
            if($a014_data_vencimento<=$dataLimiteVencimeto && $a014_data_vencimento>=$dataAtual)
            {
                $parametrosView['mensagem'] = $ParamTEXTOVENCIMENTODOCUMENTO->a000_valor??"";

                $assunto = 'Existe Documento do Contrato nº '.$contrato->a013_id_contrato.' em Prazo de Vencimento';
                $controller->enviaEmailPadraoView('sistema.email.aviso',$parametrosView,'Dealix','naoresponda@dealix.com.br',$row->a001_nome,$row->a001_email, $assunto );

                $controller->notificacaoPadrao(0,$row->a001_id_usuario,$assunto,$parametrosView['mensagem'],0,'contrato');

            }
        });



        ////////////////////COTAÇÂO//////////////////////////////
        $cotacaoController = new CotacaoController();
        $dataAtual = Carbon::now()->format('Y-m-d');
        $cotacaoCancelar = Cotacao::query()
            ->where('a018_data_prevista' ,'<', $dataAtual)
            ->where('a018_status', 'O')
            ->get();

        $cotacaoCancelar->map(function($row) use($cotacaoController){
            $row->a018_status = 'C';
            $row->save();

            $contacaoFornecedorCancelar = Cotacao_fornecedor::query()->where('a018_id_contacao',$row->a018_id_contacao )->get();
            $contacaoFornecedorCancelar->map(function($row){
                $row->a020_status = 'C';
                $row->save();
            });

            $cotacaoController->gravaHistorico( $row);

        });
        ///////////////////////////////////////////////////////


        \Log::info("cronNotificacao Terminou: $dataAtual");
        ///php artisan schedule:run
    }
}

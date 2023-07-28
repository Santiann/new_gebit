<?php

namespace App\Http\Controllers;

use App\Cidade;
use App\Email;
use App\Empresa_usuario;
use App\Notificacao;
use App\Permission;
use App\Role_user;
use App\User;
use App\Usuario;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Requests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $validaAcesso = false;

    public function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i < strlen($mask); $i++) {
            if ($mask[$i] == '#') {
                if (isset($val[$k]))
                    $maskared .= $val[$k++];
            } else {
                if (isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }

    public function retiraCaracter($valor)
    {
        $valor =  str_replace(',','',$valor);
        $valor =  str_replace('.','',$valor);
        $valor =  str_replace('-','',$valor);
        $valor =  str_replace('/','',$valor);
        $valor =  str_replace('(','',$valor);
        $valor =  str_replace(')','',$valor);
        $valor =  str_replace(' ','',$valor);
        $valor =  preg_replace("/[^0-9]/", "", $valor);
        return $valor;
    }

    public function converteDecimalDB($valor)
    {
        $valor =  str_replace('.','',$valor);
        $valor =  str_replace(',','.',$valor);
        return $valor;
    }

    public function converteMoney($valor)
    {
        setlocale(LC_MONETARY, 'pt_BR');
        return number_format($valor, 2, ',', '.');
    }

    public function enviaEmailPadraoView($view, $parametrosView, $deNome, $deEmail, $paraNome, $paraEmail, $assuntoEmail)
    {
        $view = $view??'sistema.email.aviso';
        $deNome = $deNome??'Dealix';
        $deEmail = $deEmail??'naoresponda@dealix.com.br';

        //Salvando na tabela de log de e-mail
        $requestData                    = array();
        $requestData['a997_de_nome']    = $deNome;
        $requestData['a997_de_email']   = $deEmail;
        $requestData['a997_para_nome']  = $paraNome;
        $requestData['a997_para_email'] = $paraEmail;
        $requestData['a997_assunto']    = $assuntoEmail;
        $requestData['a997_conteudo']   = $parametrosView['mensagem'];
        $cadastroEmail                  = Email::create($requestData);
        $parametrosView['a997_id_email']= $cadastroEmail->a997_id_email;

        try{
            Mail::send($view,$parametrosView, function ($message) use($paraEmail, $assuntoEmail)
            {
                $message->to($paraEmail);
                $message->subject($assuntoEmail);
            });

            if (Mail::failures()) {
                $cadastroEmail->delete();            
            }
         }catch(\Swift_TransportException $transportExp){
            $cadastroEmail->delete(); 
         }
    }

    public function notificacaoPadrao($idNotificacao=0, $idUsuario, $assunto, $conteudo, $lido, $namePagina='')
    {
        $permissao = Permission::query()->where('name',$namePagina)->first();

        $icone = $permissao->icone;

        $notificacao = Notificacao::findOrnew($idNotificacao);
        $notificacao->a001_id_usuario = $idUsuario;
        $notificacao->a996_assunto = $assunto;
        $notificacao->a996_conteudo = $conteudo;
        $notificacao->a996_ind_lido = $lido??0;
        $notificacao->a996_nome_icone = $icone;
        if($idNotificacao<=0)
            $notificacao->created_at_user = Auth::user()->id??0;
        $notificacao->updated_at_user = Auth::user()->id??0;
        $notificacao->save();
    }

    public function validaUnicoExistente (Request $request )
    {
        /// valida se é email
        if(strpos($request->nameColunaValidar,'email'))
        {

        }
        elseif(strpos($request->nameColunaValidar,'cpf') || strpos($request->nameColunaValidar,'cnpj'))
        {
            $request->valorDigitado = str_replace([",",'.','-','/'],"",$request->valorDigitado);
        }
        else{
            //quando cpf ou cnpj ou email entao nao precisa validar por empresa
            //retorna 2 pra json do ajax mostrar msg de necessario seleionar empresa
            if($request->idEmpresa == null)
            {
                return 2;
            }
        }

        $requestData = $request->all();
        //dump($requestData,$request->valorDigitado, strpos($request->nameColunaValidar,'cpf'));



        $retorno = 0;
        $valida = 1;
        $valida = DB::table($request->nametabela)
            ->where($request->nameColunaValidar, '=', '' . $request->valorDigitado . '')
            ->where(function($where) use($request){
                if($request->idEdit != '0')
                    $where->where($request->nameColunaPK,'!=',$request->idEdit);
            })
            ->where(function($where) use($request)
            {
                if(strpos($request->nameColunaValidar,'cpf') || strpos($request->nameColunaValidar,'cnpj') || strpos($request->nameColunaValidar,'email'))
                {
                    //quando cpf ou cnpj ou email entao nao precisa validar por empresa
                }
                else {
                    $where->where('a005_id_empresa', $request->idEmpresa);
                }
            })
            ->first();


        if (isset($valida)) {
            $retorno = 1;
        } else {
            $retorno = 0;
        }

        $retorno = json_decode($retorno);
        return $retorno;
    }

    public function validaAcessoEdit($idEmpresa, $ligacaoid, $idFornecedor=0)
    {
        /// deixar mais generico por causa de saber de onde vem pra saber o que deve validar
        /// pois abaixo esta validando a eidção de usuario

        /// valida se nao é um ind_super_admin
        /// se nao é super adm tem que validar para nao editar de outras empresas cadastradas
        if (Auth::user()->ind_super_adm<=0) {

            switch  ($ligacaoid)
            {
                case "uruario":
                    ///busca todos os ids das empresas que o usuario logado tem relação
                    $idsEmpresaUsuarioLogado = Empresa_usuario::query()
                        ->where('a001_id_usuario', '=', Auth::user()->a001_id_usuario)
                        ->where('a004_dono_cadastro', 1)
                        ->pluck('a005_id_empresa')->toArray();

                    ///busca todos os usuarios de todas as empresas que o usuario logado tem acesso
                    $idsUsuarioDasEmpresas = Empresa_usuario::query()->wherein('a005_id_empresa', $idsEmpresaUsuarioLogado)->pluck('a001_id_usuario')->toArray();

                    /// verifica se o id que esta sendo editado tem no array dos ids $idsUsuarioDasEmpresas
                    /// isto é se o cadastro feito foi pela empresa que o usuario cadastrou
                    /// validar tb se a empresa é fornecedor do cadastro
                    if ((!in_array($idEmpresa, $idsUsuarioDasEmpresas))&&(!in_array($idFornecedor, $idsUsuarioDasEmpresas))) {

                        abort(401);
                    }
                    break;

                case 'empresa':
                    ///busca todos os ids das empresas que o usuario logado tem relação
                    $idsEmpresaUsuarioLogado = Empresa_usuario::query()
                        ->where('a001_id_usuario', '=', Auth::user()->a001_id_usuario)
                        ->where('a004_dono_cadastro', 1)
                        ->pluck('a005_id_empresa')->toArray();



                    ///verifica se o id que esta sendo editado tem no array dos ids $idsEmpresaUsuarioLogado
                    if ((!in_array($idEmpresa, $idsEmpresaUsuarioLogado))&&(!in_array($idFornecedor, $idsEmpresaUsuarioLogado))) {

                        abort(401);
                    }
                    break;

                case 'show':
                    ///busca todos os ids das empresas que o usuario logado tem relação
                    $idsEmpresaUsuarioLogado = Empresa_usuario::query()
                        ->where('a001_id_usuario', '=', Auth::user()->a001_id_usuario)
                        //->where('a004_dono_cadastro', 1)
                        ->pluck('a005_id_empresa')->toArray();



                    ///verifica se o id que esta sendo editado tem no array dos ids $idsEmpresaUsuarioLogado
                    if ((!in_array($idEmpresa, $idsEmpresaUsuarioLogado))&&(!in_array($idFornecedor, $idsEmpresaUsuarioLogado))) {

                        abort(401);
                    }
                    break;


            }

        }
        return true;
    }

    public function meusdados()
    {
        $email = Auth::user()->email;

        //dump(Auth::user());

        $usuarioController = new UsuarioController();

        $usuario = Usuario::where('a001_email', $email)->first();

        if (!$usuario)
            return abort(403);

        $idEstado = Cidade::query()->where('a047_id_cidade', $usuario->a047_id_cidade)->first()->a048_id_estado ?? 0;
        $comboCidade = $usuarioController->optionCidade($idEstado);
        $comboEstado = $usuarioController->optionEstado();
        $role = $usuarioController->listaPerfil();
        $empresa = $usuarioController->listaEmpresa();

        $usuario->a048_id_estado = $idEstado;

        $Empresa_usuario = Empresa_usuario::query()
            ->where('a001_id_usuario',$usuario->a001_id_usuario)
            ->pluck('a005_id_empresa')->toArray();

        $user = (User::query()->where('email',$usuario->a001_email)->select('id')??[])->pluck('id');

        $Role_user = Role_user::query()
            ->wherein('user_id',$user)
            ->pluck('role_id')->toArray()
        ;

        $usuario->a005_id_empresa = $Empresa_usuario;
        $usuario->role_id = $Role_user;

        return view('sistema.usuario.meusDados', compact('usuario','comboCidade','comboEstado', 'role','empresa'));
    }

    public function idsEmpresaDonoCadastro()
    {
        $empresa = Empresa_usuario::query()
            ->join('t005_empresa', 't004_empresa_usuario.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
            ->where('a005_ind_empresa', 1)
            ->where('a004_dono_cadastro', 1)
            ->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario)
            ->where('t004_empresa_usuario.a004_dono_cadastro', '=', 1)
            ->pluck('t004_empresa_usuario.a005_id_empresa')->toArray();

        return $empresa;
    }
}

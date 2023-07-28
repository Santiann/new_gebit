<?php

namespace App\Http\Controllers;

use App\Empresa_usuario;

use App\Http\Requests;
use App\User;
use App\Usuario;

use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Session;
use Auth;
use Entrust;

class RegistrarController extends Controller
{
    public function __construct()
    {

    }

    public function create()
    {

        $empresa = new EmpresaController();
        $comboCidade = $empresa->optionCidade(0);
        $comboEstado = $empresa->optionEstado();
        $comboTipo_cliente = $empresa->optionTipo_cliente();
        $comboTipo_empresa = $empresa->optionTipo_empresa();
        //$comboEmpresaPai = $empresa->optionEmpresaPai(0);
        $optionTipo_contato = $empresa->optionTipo_contato();


        return view('vendor.adminlte.register', compact('comboCidade', 'comboTipo_cliente', 'comboTipo_empresa', 'comboEstado', 'optionTipo_contato'));

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            //'a005_cpf_cnpj' => 'required',
            //'a005_nome_completo' => 'required',
            //'a005_email' => 'required',
            'a001_cpf' => 'required',
            'a001_nome_completo' => 'required',
            'a001_email' => 'required',
            //'a005_fone' => 'required',
            //'a005_cep' => 'required',
            //'a005_endereco' => 'required',
            //'a005_numero_end' => 'required',
            //'a005_bairro' => 'required',
            //'a048_id_estado' => 'required',
            //'a047_id_cidade' => 'required',
        ]);
        $requestData = $request->all();
        $requestData['created_at_user'] = Auth::user()->id??0;
        $requestData['updated_at_user'] = Auth::user()->id??0;
        $requestData['a005_tipo_empresa'] = 'M';

        $requestData['a005_ind_empresa'] = 1;
        $requestData['a005_ind_cliente'] = 0;
        $requestData['a005_ind_estrangeiro'] = 0;
        $requestData['a005_ind_fornecedor'] = 0;
        $requestData['a004_dono_cadastro'] = $requestData['a004_dono_cadastro'] ?? 1;
        $requestData['a005_status'] = $requestData['a005_status'] ?? 1;
        $requestData['a005_cnpj'] = $this->retiraCaracter($requestData['a005_cnpj']??'');
        $requestData['a001_cpf'] = $this->retiraCaracter($requestData['a001_cpf']??'');

        if(($requestData['a005_cnpj']??"") == '')
        {
            $requestData['a005_tipo_cliente']  = "F";
            $requestData['a005_cpf']  = $requestData['a001_cpf'];
            $requestData['a005_nome_completo']  = $requestData['a001_nome_completo'];
        }
        else{
            $requestData['a005_cnpj'] = $requestData['a005_cnpj'];
            $requestData["a005_nome_fantasia"] = $requestData['a005_nome_fantasia'];
            $requestData["a005_razao_social"] = $requestData['a005_razao_social'];
            $requestData['a005_tipo_cliente'] = "J";
        }

        $requestData['a005_cep'] = $this->retiraCaracter($requestData['a005_cep']??0);
        $requestData['a005_fone'] = $requestData['a005_fone']??$requestData['a005_foneSemMask']??'';
        $requestData['a005_fone'] = $this->retiraCaracter($requestData['a005_fone'])??'';
        $requestData["a005_id_empresa"] = $requestData["a005_id_empresa"]??0;


        DB::beginTransaction();
        try {

            //upload de arquivos da aba comercial
            if($request->hasFile('a005_logo')) {

                Storage::disk('public')->delete($empresa->a005_logo??"");

                $arquivo = $request->file('a005_logo');
                $fileName = str_random(12) . '.' . $arquivo->getClientOriginalExtension();
                $path = $arquivo->storeAs('uploads/empresa', $fileName, 'public');
                $requestData['a005_logo'] = '/uploads/empresa/' . $fileName;
            }

            $usuario = new Usuario();
            $usuario->a001_nome = $requestData['a001_nome_completo']??($requestData["a001_email"]);
            $usuario->a001_email = $requestData['a001_email'];
            $usuario->a001_cep = $requestData['a005_cep'];
            $usuario->a001_telefone = $requestData['a005_fone'];
            $usuario->a001_endereco = $requestData['a005_endereco'];
            $usuario->a001_numero_end = $requestData['a005_numero_end'];
            $usuario->a047_id_cidade = $requestData['a047_id_cidade'];
            $usuario->a001_complemento = $requestData['a005_complemento_end'];
            $usuario->a001_bairro = $requestData['a005_bairro'];
            $usuario->a001_cpf = $requestData['a001_cpf']??null;
            $usuario->a001_status = 1;
            $usuario->save();

            $user = new User();
            $user->name = $requestData['a001_nome_completo']??($requestData["a001_email"]);
            $user->email = $requestData['a001_email'];
            $user->password = Str::random(20);
            $user->foto = $requestData['a005_logo']??"";
            $user->ativo = 1;
            $user->a001_id_usuario = $usuario->a001_id_usuario;
            $user->cadastro_completo = 0;
            $user->api_token = Str::random(20);
            $user->remember_token = Str::random(10);
            $user->username = $requestData['a001_email'];
            //$user->create_password
            $user->primeiro_acesso = 1;
            $user->ind_super_adm = 0;
            $user->ind_adm = 1 ;
            $user->save();

            $empresa = Empresa::create($requestData);

            //relaciona a empresa com o usuario logado
            $empresaUsuario = Empresa_usuario::query()->Create([
                'a001_id_usuario' => $usuario->a001_id_usuario,
                'a005_id_empresa' => $empresa->a005_id_empresa,
                'a004_dono_cadastro' => '1',
                'created_at_user'  => $user->id
            ]);

            $empresaController = new EmpresaController();

            $empresaController->relacionaPerfil($empresa->a005_id_empresa,$usuario->a001_id_usuario,$user->id);

            $token = Password::createToken($user);
            ///envia o email para cadastrar senha
            $user->sendPasswordResetNotification($token);

//dump($requestData,$empresaUsuario);

            Session::flash('flash_message', 'Enviamos um e-mail com as instruções e o link para registrar a senha!');
            DB::commit();

            return redirect('login');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            Session::flash('flash_message', 'Não foi possível Criar a Empresa!');
            return redirect('empresa');
        }
    }
    public function buscaExistente(Request $request)
    {
        $valordigitado = $this->retiraCaracter($request->valorDigitado);

        $empresa = Empresa::query()
            ->leftjoin('t047_cidade','t047_cidade.a047_id_cidade','=','t005_empresa.a047_id_cidade')
            ->where(function($where) use($valordigitado){
                if(strlen($valordigitado)==11) {
                    $where->where('a005_cpf', $valordigitado);
                }
                elseif(strlen($valordigitado)==14) {
                    $where->where('a005_cnpj', $valordigitado);
                }
                else{
                    $where->where('a005_cod_identificacao', $valordigitado);
                }
            })
            ->select('a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa'
                ,'a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia'
                ,'a005_ie','a005_im','a005_fone','a005_email','a005_cep','t005_empresa.a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end'
                ,'a005_status','a048_id_estado')
            ->first();

        return $empresa;
    }

}

<?php namespace Dealix\Register\Classes;

use Dealix\Register\Models\Company as Empresa;
use Dealix\Register\Models\Company_user as Empresa_usuario;
use Dealix\Register\Models\Role;
use Dealix\Register\Models\UserRoles as UsuarioRoles;
use Dealix\Register\Models\User as Usuario;
use Dealix\Register\Models\User_Auth as User;
use Auth;
use Session;
use File;
use Storage;
use Str;
use Db;
use Lang;
use Mail;
use Validator;
use ValidationException;
use ApplicationException;
use Cms\Classes\Controller;
use RainLab\User\Models\User as UserModel;
use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;
use Authy\AuthyApi;


class Register
{
    public function startVerification() {
        $twilio = new Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));
        $verification_sid = env('TWILIO_VERIFICATION_SID');

        $data = post();
        $data['via'] = 'sms';
        $validator = $this->verificationRequestValidator($data);
        extract($data);

        if ($validator->passes()) {
            try {
                $verification = $twilio->verify->v2->services($verification_sid)
                ->verifications
                ->create('+55'.$phone_number, $via);
                
                return response()->json($verification->sid, 200);
            } catch (TwilioException $exception) {
                $message = "Verification failed to start: {$exception->getMessage()}";
                return response()->json($message, 400);
            }
        }

        return response()->json(['errors'=>$validator->errors()], 403);
    }

    public function verifyCode() {
        $twilio = new Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));
        $verification_sid = env('TWILIO_VERIFICATION_SID');

        $data = post();
        $validator = $this->verificationCodeValidator($data);
        extract($data);

        if ($validator->passes()) {
            try {
                $verification_check = $twilio->verify->v2->services($verification_sid)
                            ->verificationChecks
                            ->create($token, ['to' => '+55'.$phone_number]);
                if ($verification_check->status === 'approved') {
                    return response()->json($verification_check->sid, 200);
                }
                throw new Exception('Verificação OTP falhou');
            } catch (TwilioException $e) {
                $response=[];
                $response['exception'] = get_class($e);
                $response['message'] = $e->getMessage();
                $response['trace'] = $e->getTrace();
                return response()->json($response, 403);
            }
        }

        return response()->json(['errors'=>$validator->errors()], 403);
    }

    protected function verificationRequestValidator(array $data)
    {
        return Validator::make($data, [
            'phone_number' => 'required|string',
            'via' => 'required|string|max:4',
        ]);
    }

    protected function verificationCodeValidator(array $data)
    {
        return Validator::make($data, [
            'phone_number' => 'required|string',
            'token' => 'required|string|max:10'
        ]);
    }

    private static function retiraCaracter($valor)
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

    /// valida o perfil da empresa se estiver com os check marcados
    private static function relacionaPerfil($a005_id_empresa, $a001_id_usuario, $id)
    {
        $idUsuario = $a001_id_usuario??Auth::user()->a001_id_usuario;
        $idUser = $id??Auth::user()->id;

        //busca todas as empresas do usuario
        $userEmpresa = Empresa_usuario::query()->where('a001_id_usuario', $idUsuario)->select('a005_id_empresa')->get()->toArray();

        //todas as empresas do usuario
        $empresa = Empresa::query()->wherein('a005_id_empresa', $userEmpresa)->get();

        //busca os perfis adm, cliente, fornecedor
        $perfil = Role::query()->orWhere('ind_adm', 1)->orWhere('ind_cliente', 1)->orWhere('ind_fornecedor', 1)->get();

        ///pega os inds marcados na tela, em vez de pegar do request, peguei da empresa que ja foi salva antes de entrar nessa funcao
        $ind_empresa = $empresa->Sum('a005_ind_empresa');
        $ind_cliente = $empresa->Sum('a005_ind_cliente');
        $ind_fornecedor = $empresa->Sum('a005_ind_fornecedor');

        //aqui pega as PK de cada perfil pra poder gravar;
        $perfil_adm = $perfil->where('ind_adm', 1)->values()[0];
        $perfil_cli = $perfil->where('ind_cliente', 1)->values()[0];
        $perfil_for = $perfil->where('ind_fornecedor', 1)->values()[0];



        ///relaciona como empresa do sistema caso steja marcado ind_empresa
        if ($ind_empresa > 0) {
            $role_user = UsuarioRoles::query()->updateOrCreate(['user_id' => $idUser, 'role_id' => $perfil_adm->id]);
        } else {
            $role_user = UsuarioRoles::query()->where('user_id', $idUser)->where('role_id', $perfil_adm->id)->delete();
        }

        ///relaciona como perfil de cliente caso esteja o ind_cliente marcado
        if ($ind_cliente > 0) {
            $role_user = UsuarioRoles::query()->updateOrCreate(['user_id' => $idUser, 'role_id' => $perfil_cli->id]);
        } else {
            $role_user = UsuarioRoles::query()->where('user_id', $idUser)->where('role_id', $perfil_cli->id)->delete();
        }

        ///relaciona como perfil de fornecedor caso esteja o ind_fornecedor marcado
        if ($ind_fornecedor > 0) {
            $role_user = UsuarioRoles::query()->updateOrCreate(['user_id' => $idUser, 'role_id' => $perfil_for->id]);
        } else {
            $role_user = UsuarioRoles::query()->where('user_id', $idUser)->where('role_id', $perfil_for->id)->delete();
        }
    }
    
    public static function registerOnSystem($requestObj)
    {
        $requestData = (array) $requestObj;
        $requestData['a001_nome_completo'] = $requestData['name'];
        $requestData['a001_email'] = $requestData['email'];
        $requestData['created_at_user'] = Auth::user()->id??0;
        $requestData['updated_at_user'] = Auth::user()->id??0;
        $requestData['a005_tipo_empresa'] = 'M';

        $requestData['a005_ind_empresa'] = 1;
        $requestData['a005_ind_cliente'] = 0;
        $requestData['a005_ind_estrangeiro'] = 0;
        $requestData['a005_ind_fornecedor'] = 0;
        $requestData['a004_dono_cadastro'] = $requestData['a004_dono_cadastro'] ?? 1;
        $requestData['a005_status'] = $requestData['a005_status'] ?? 1;
        $requestData['a005_cnpj'] = self::retiraCaracter($requestData['a005_cnpj']??'');
        $requestData['a001_cpf'] = self::retiraCaracter($requestData['a001_cpf']??'');

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

        $requestData['a005_cep'] = self::retiraCaracter($requestData['a005_cep']??0);
        $requestData['a005_fone'] = $requestData['a005_fone']??$requestData['a005_foneSemMask']??'';
        $requestData['a005_fone'] = self::retiraCaracter($requestData['a005_fone'])??'';
        $requestData["a005_id_empresa"] = $requestData["a005_id_empresa"]??0;
        


        Db::beginTransaction();
        try {

            //upload de arquivos da aba comercial
            if(isset($request['a005_logo'])) {

                Storage::disk('public')->delete($empresa->a005_logo??"");

                $arquivo = $request->file('a005_logo');
                $fileName = str_random(12) . '.' . $arquivo->getClientOriginalExtension();
                $path = $arquivo->storeAs('uploads/empresa', $fileName, 'public');
                $requestData['a005_logo'] = '/uploads/empresa/' . $fileName;
            }


            $usuario = Usuario::where('a001_email', $requestData['a001_email'])->first();

            if (!$usuario) {
                $usuario = new Usuario();
                $usuario->a001_nome = $requestData['a001_nome_completo']??($requestData["a001_email"]);
                $usuario->a001_email = $requestData['a001_email'];
                $usuario->a001_cargo = $requestData['a001_cargo'];
                $usuario->a001_cep = str_replace('-', '', $requestData['a001_cep']);
                $usuario->a001_telefone = str_replace(['(', ')', ' '], '', $requestData['a001_telefone']);;
                $usuario->a001_endereco = $requestData['a001_endereco'];
                $usuario->a001_numero_end = $requestData['a001_numero_end'];
                $usuario->a047_id_cidade = $requestData['a001_id_cidade'];
                $usuario->a001_complemento = $requestData['a001_complemento_end'];
                $usuario->a001_bairro = $requestData['a001_bairro'];
                $usuario->a001_cpf = $requestData['a001_cpf']??null;
                $usuario->a001_status = 1;
                
                $usuario->save();
            }

            $user = User::where('email', $requestData['a001_email'])->first();

            if (!$user) {
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
                $user->creditos = env('CONTRATOS_GRATUITOS');
                $user->save();
            }

            \Session::put('api_token', $user->api_token);

            //mudando id_cidade para o da empresa
            $requestData['a047_id_cidade'] = $requestData['a005_id_cidade'];
            $empresa = Empresa::create($requestData);

            //relaciona a empresa com o usuario logado
            $empresaUsuario = Empresa_usuario::query()->Create([
                'a001_id_usuario' => $usuario->a001_id_usuario,
                'a005_id_empresa' => $empresa->a005_id_empresa,
                'a004_dono_cadastro' => '1',
                'created_at_user'  => $user->id
            ]);

            self::relacionaPerfil($empresa->a005_id_empresa, $usuario->a001_id_usuario, $user->id);


            // $token = Password::createToken($user);
            ///envia o email para cadastrar senha 
            // $user->sendPasswordResetNotification($token);
            //dump($requestData,$empresaUsuario);

            Session::flash('flash_message', 'Enviamos um e-mail com as instruções e o link para registrar a senha!');
            Db::commit();

            return $user;

        } catch (\Exception $e) {
            Db::rollBack();
            dd($e->getMessage());
            Session::flash('flash_message', 'Não foi possível Criar a Empresa!');
            return redirect('empresa');
        }
    }
}
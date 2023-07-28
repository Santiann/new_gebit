<?php

namespace App\Http\Controllers;

use App\Cidade;
use App\Empresa;
use App\Empresa_usuario;
use App\Estado;
use App\Http\Controllers\_DefaultController as DefaultController;
use App\Role;
use App\Role_user;
use App\User;
use App\User_site;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\DataTables;

use App\Usuario;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Session;
use Auth;
use Entrust;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
    public function __construct()
    {

        $this->middleware(['permission:usuario-show|usuario-create|usuario-edit|usuario-delete']);

    }

    public function datatable(Request $request)
    {
        $edit = Entrust::can('usuario-edit');
        $delete = Entrust::can('usuario-delete');

        //busca todas as empresas do usuario
        $userEmpresa = Empresa_usuario::query()
            ->where('a001_id_usuario', Auth::user()->a001_id_usuario)
            ->where('a004_dono_cadastro', 1)
            ->select('a005_id_empresa')
            ->get()->toArray();



        return Datatables::of(
            Usuario::query()
                ->join('t004_empresa_usuario', 't004_empresa_usuario.a001_id_usuario', '=', 't001_usuario.a001_id_usuario')
                ->where('a004_dono_cadastro', 1)
                ->where(function ($where) use ($userEmpresa) {
                    if(Auth::user()->ind_super_adm<=0) {
                        $where->wherein('t004_empresa_usuario.a005_id_empresa', $userEmpresa);
                    }
                })
                ->select('t001_usuario.a001_id_usuario', 't001_usuario.a001_nome', 't001_usuario.a001_email', 't001_usuario.a001_status', 'a001_cpf')
                ->distinct()
        )
            ->addColumn('action', function ($row) use ($edit, $delete) {
                $acoes = "";
                if ($edit) {
                    $acoes .= '<a class="btn btn-xs btn-primary" title="Editar Usuário" href="/usuario/' . $row->a001_id_usuario . '/edit" ><span class="fa fa-edit" aria-hidden="true"></span></a> ';
                }
                if ($delete) {
                    $acoes .= '<form method="POST" action="/usuario/' . $row->a001_id_usuario . '" style="display:inline">
                    <input name="_method" value="DELETE" type="hidden">
                    ' . csrf_field() . '
                    <button type="button" class="btn btn-xs btn-danger" title="Excluir Usuário" onclick="ConfirmaExcluir(\'Confirma Excluir Usuario?\',this)">
                       <span class="fa fa-trash"></span>
                    </button>
                </form>';
                }
                return $acoes;
            })
            ->editColumn('a001_status', function ($status) {

                if (isset($status->a001_status)) {
                    if ($status->a001_status == '1') {
                        $labelStatus = '<span class="label label-success"><i class="glyphicon glyphicon-ok"></i> &ensp;Ativo </span>';
                        return $labelStatus;

                    } else {
                        $labelStatus = '<span class="label label-warning"><i class="glyphicon glyphicon-remove"></i> &ensp;Inativo </span>';
                        return $labelStatus;
                    }
                }
            })
            ->filterColumn('a001_status', function ($query, $keyword) {
                $query->where(function ($where) use ($query, $keyword) {
                    if (strpos(strtoupper('Ativo'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a001_status', '1');
                    }
                    if (strpos(strtoupper('Inativo'), strtoupper($keyword)) !== false) {
                        $where->orwhere('a001_status', '0');
                    }
                });
            })
            ->editColumn('a001_cpf', function ($row) {

                if (($row->a001_cpf ?? "") != "") {
                    $row->a001_cpf = $this->mask($row->a001_cpf, '###.###.###-##');
                }
                else {
                    $row->a001_cpf = "";
                }
                return $row->a001_cpf;
            })
            ->filterColumn('a001_cpf', function ($query, $keyword)  {

                $query->where('a001_cpf','like','%'.'125'.'%');

            })
            ->escapeColumns(['*'])
            ->make(true);
    }

    public function index(Request $request)
    {
        return view('sistema.usuario.index');
    }

    public function create()
    {
        $comboCidade = $this->optionCidade(0);
        $comboEstado = $this->optionEstado();
        $role = $this->listaPerfil();
        $empresa = $this->listaEmpresa();

        return view('sistema.usuario.create', compact('comboCidade', 'comboEstado','role','empresa'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
			'a001_nome' => 'required',
			'a001_email' => 'required',
			'a001_telefone' => 'required',
			'a001_cep' => 'required',
			'a001_endereco' => 'required',
			'a001_numero_end' => 'required',
			'a048_id_estado' => 'required',
			'a047_id_cidade' => 'required',
			'a001_bairro' => 'required',
			'a005_id_empresa' => 'required',
		]);
        $requestData = $request->all();
        $requestData['created_at_user'] = Auth::user()->id;
        $requestData['updated_at_user'] = Auth::user()->id;
        $requestData['a001_status'] = $requestData['a001_status']??0;
        $requestData['a004_dono_cadastro'] = $requestData['a004_dono_cadastro']??1;
        $requestData['a001_cpf'] = $this->retiraCaracter($requestData['a001_cpf']);


        DB::beginTransaction();
        try {

            //upload de arquivos da aba comercial
            if($request->hasFile('a001_foto')) {

                $arquivo = $request->file('a001_foto');
                $fileName = str_random(12) . '.' . $arquivo->getClientOriginalExtension();
                $path = $arquivo->storeAs('uploads/usuario', $fileName, 'public');
                $requestData['a001_foto'] = '/uploads/usuario/' . $fileName;
            }

            $usuario = Usuario::create($requestData);

            $user = new User();
            $user->password = Str::random(20);
            $user->name = $usuario->a001_nome;
            $user->email = $usuario->a001_email;
            $user->ativo = $usuario->a001_status;
            $user->a001_id_usuario = $usuario->a001_id_usuario;
            $user->cadastro_completo = 1;
            $user->creditos = 0;
            $user->save();

            $user->Role_user_hasMany()->attach($requestData['role_id']??[]);



            foreach ($requestData['a005_id_empresa'] as $item) {
                $Empresa_usuario = new Empresa_usuario();
                $Empresa_usuario->a005_id_empresa = $item;
                $Empresa_usuario->a001_id_usuario = $usuario->a001_id_usuario;
                if(Auth::user()->ind_super_adm<=0) {
                    $Empresa_usuario->a004_dono_cadastro = 1;
                }
                else {
                    $Empresa_usuario->a004_dono_cadastro = 0;
                }
                $Empresa_usuario->save();
            }

            ///Relacionandooutras empresas que o usuario tera acesso nao sendo dono do cadastro
            $userEmpresa_relacionadas = Empresa::query()
                ->join('t004_empresa_usuario', function($join){
                    $join-> on('t004_empresa_usuario.a005_id_empresa','=','t005_empresa.a005_id_empresa');
                    $join->where('t004_empresa_usuario.a001_id_usuario', Auth::user()->a001_id_usuario);
                })
                ->where(function ($where) {
                    $where->where('a004_dono_cadastro',0);
                })

                ->pluck('t005_empresa.a005_id_empresa')->values()->toArray();

            foreach ($userEmpresa_relacionadas as $item) {
                $Empresa_usuario = new Empresa_usuario();
                $Empresa_usuario->a005_id_empresa = $item;
                $Empresa_usuario->a001_id_usuario = $usuario->a001_id_usuario;
                $Empresa_usuario->a004_dono_cadastro = 0;
                $Empresa_usuario->save();
            }



            $token = Password::createToken($user);
            ///envia o email para cadastrar senha
            $user->sendPasswordResetNotification($token);

            Session::flash('flash_message', 'Usuário adicionado!');
            DB::commit();
            return redirect('usuario');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            Session::flash('flash_message', 'Não foi possível adicionar o Usuário!');
            return redirect('usuario');
        }
    }

    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        $comboCidade = $this->optionCidade($idEstado);
        $comboEstado = $this->optionEstado();


        return view('sistema.usuario.show', compact('usuario','comboCidade', 'comboEstado'));
    }

    public function edit($id)
    {
        $this->validaAcessoEdit($id, 'usuario');

        $usuario = Usuario::findOrFail($id);
        $idEstado = Cidade::query()->where('a047_id_cidade', $usuario->a047_id_cidade)->first()->a048_id_estado ?? 0;
        $comboCidade = $this->optionCidade($idEstado);
        $comboEstado = $this->optionEstado();
        $role = $this->listaPerfil();
        $empresa = $this->listaEmpresa();

        $usuario->a048_id_estado = $idEstado;


        $Empresa_usuario = Empresa_usuario::query()
            ->where('a001_id_usuario',$id)
            ->pluck('a005_id_empresa')->toArray();

        $user = (User::query()->where('a001_id_usuario',$id)->select('id')??[])->pluck('id');


        $Role_user = Role_user::query()
            ->wherein('user_id',$user)
            ->pluck('role_id')->toArray()
        ;

        $usuario->a005_id_empresa = $Empresa_usuario;
        $usuario->role_id = $Role_user;

        /*Auth::user()->ind_super_adm = 0;
        $requestData['a005_id_empresa'] = [7,8];
        dump([Auth::user()->ind_super_adm,$requestData['a005_id_empresa']]);

        $userEmpresa_relacionadas = Empresa::query()
            ->join('t004_empresa_usuario', function($join)use($id){
                $join-> on('t004_empresa_usuario.a005_id_empresa','=','t005_empresa.a005_id_empresa');
                $join->where('t004_empresa_usuario.a001_id_usuario', $id);
            })
            ->where(function ($where) use ($requestData) {
                if(Auth::user()->ind_super_adm<=0) {
                    $where->where('a004_dono_cadastro',0);
                }
                else
                {
                    ////$where->wherenotin('t004_empresa_usuario.a005_id_empresa',$requestData['a005_id_empresa']);///empresas relacionadas
                }
            })

            ->pluck('t005_empresa.a005_id_empresa')->values()->toArray();

        dump(['$userEmpresa_relacionadas',$userEmpresa_relacionadas]);

        $usr_empresaDel = Empresa_usuario::query()
            ->where('t004_empresa_usuario.a001_id_usuario', $id)
            ->wherenotin('t004_empresa_usuario.a005_id_empresa',$requestData['a005_id_empresa']??[0])
            ->wherenotin('t004_empresa_usuario.a005_id_empresa',$userEmpresa_relacionadas??[0])
            ->get();
        dump(['$usr_empresaDel',$usr_empresaDel]);

        $empresasNaoRelacioadas = array_diff($requestData['a005_id_empresa'], $userEmpresa_relacionadas);
        dump(['$empresasNaoRelacioadas',$empresasNaoRelacioadas]);

        $userEmpresaInsert = Empresa::query()
            ->leftjoin('t004_empresa_usuario', function($join)use($id){
                $join-> on('t004_empresa_usuario.a005_id_empresa','=','t005_empresa.a005_id_empresa');
                $join->where('t004_empresa_usuario.a001_id_usuario', $id);
            })
            ->wherein('t005_empresa.a005_id_empresa',$requestData['a005_id_empresa'])
            ->wherenotin('t005_empresa.a005_id_empresa',$userEmpresa_relacionadas??[0])
            ->whereNull('t004_empresa_usuario.a005_id_empresa')
            ->select('t005_empresa.a005_id_empresa')
            ->pluck('a005_id_empresa')->values()->toArray();
        dump(['userEmpresaInsert',$userEmpresaInsert]);
*/


        return view('sistema.usuario.edit', compact('usuario','comboCidade','comboEstado', 'role','empresa'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'a001_nome' => 'required',
            'a001_email' => 'required',
            'a001_telefone' => 'required',
            'a001_cep' => 'required',
            'a001_endereco' => 'required',
            'a001_numero_end' => 'required',
            'a048_id_estado' => 'required',
            'a047_id_cidade' => 'required',
            'a001_bairro' => 'required',
            'a005_id_empresa' => 'required',
            'new_password' => ['required_with:password', $request->password ? 'regex:"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"' : ''],
            'confirm_new_password' => 'required_with:new_password|same:new_password',
        ],
        [],
        [
          'new_password' => 'nova senha',  
          'confirm_new_password' => 'confirmação nova senha',
        ]);
        
        $requestData = $request->all();
        $requestData['created_at_user'] = Auth::user()->id;
        $requestData['updated_at_user'] = Auth::user()->id;
        $requestData['a001_status'] = $requestData['a001_status']??0;
        $requestData['a001_cpf'] = $this->retiraCaracter($requestData['a001_cpf']);

        DB::beginTransaction();
        try {

            $usuario = Usuario::findOrFail($id);

            //upload de arquivos da aba comercial
            if($request->hasFile('a001_foto')) {

                Storage::disk('public')->delete($usuario->a001_foto??"");

                $arquivo = $request->file('a001_foto');
                $fileName = str_random(12) . '.' . $arquivo->getClientOriginalExtension();
                $path = $arquivo->storeAs('uploads/usuario', $fileName, 'public');
                $requestData['a001_foto'] = '/uploads/usuario/' . $fileName;
            }
            $usuario->update($requestData);


            $user = User::where('a001_id_usuario' , $usuario->a001_id_usuario)->first();
            if($user==null)
            {
                $user = new User();
                $user->password = Str::random(20);
            }
            $user->name = $usuario->a001_nome;
            $user->email = $usuario->a001_email;
            $user->ativo = $usuario->a001_status;
            $user->a001_id_usuario = $usuario->a001_id_usuario;
            $user->cadastro_completo = 1;
            $user->save();

            // alterar senha
            if (isset($requestData['password'])) {
                $hasher = app('hash');
                $user_site = User_site::where('email', $user->email)->first();

                if ($hasher->check($requestData['password'], $user->password)) {
                    $user_site->password = $user->password = $hasher->make($requestData['new_password']);
                    $user->save();
                    $user_site->save();
                }
            }

            $roleadm = [0];
            ///nao pode deletar os perfis ind_adm, ind_cliente, ind_fornecedor, ind_super_adm
            ///$roleadm = Role::query()->orWhere(['ind_super_adm'=>1,'ind_adm'=>1,'ind_cliente'=>1,'ind_fornecedor'=>1])->get('id')->pluck('id')->values()->toArray();
            /// mudado a regra agora pode adicionar e remover
            $role_userDel = Role_user::query()->where('user_id','=',$user->id)
                ->where(function($where) use($roleadm){
                    if(Auth::user()->ind_super_adm<=0) {
                        $where->whereNotIn('role_id',$roleadm);
                    }
                })
                ->delete();

            $user->Role_user_hasMany()->attach($requestData['role_id']??[]);


            /*
            $userEmpresaInsert = Empresa::query()
                ->leftjoin('t004_empresa_usuario', function($join)use($id){
                    $join-> on('t004_empresa_usuario.a005_id_empresa','=','t005_empresa.a005_id_empresa');
                    $join->where('t004_empresa_usuario.a001_id_usuario', $id);
                })
                ->wherein('t005_empresa.a005_id_empresa',$requestData['a005_id_empresa'])
                ->whereNull('t004_empresa_usuario.a005_id_empresa')
                ->select('t005_empresa.a005_id_empresa')
                ->pluck('a005_id_empresa')->values()->toArray();

            $usr_empresaDel = Empresa_usuario::query()
                ->where('t004_empresa_usuario.a001_id_usuario', $id)
                ->wherenotin('t004_empresa_usuario.a005_id_empresa',$requestData['a005_id_empresa'])
                ->delete();///*/

            $userEmpresa_relacionadas = Empresa::query()
                ->join('t004_empresa_usuario', function($join)use($id){
                    $join-> on('t004_empresa_usuario.a005_id_empresa','=','t005_empresa.a005_id_empresa');
                    $join->where('t004_empresa_usuario.a001_id_usuario', $id);
                })
                ->where(function ($where) use ($requestData) {
                    if(Auth::user()->ind_super_adm<=0) {
                        $where->where('a004_dono_cadastro',0);
                    }
                    else
                    {
                        ////$where->wherenotin('t004_empresa_usuario.a005_id_empresa',$requestData['a005_id_empresa']);///empresas relacionadas
                    }
                })

                ->pluck('t005_empresa.a005_id_empresa')->values()->toArray();

            //dump(['$userEmpresa_relacionadas',$userEmpresa_relacionadas]);

            $usr_empresaDel = Empresa_usuario::query()
                ->where('t004_empresa_usuario.a001_id_usuario', $id)
                ->wherenotin('t004_empresa_usuario.a005_id_empresa',$requestData['a005_id_empresa']??[0])
                ->wherenotin('t004_empresa_usuario.a005_id_empresa',$userEmpresa_relacionadas??[0])
                ->delete();
            //dump(['$usr_empresaDel',$usr_empresaDel]);

            $empresasNaoRelacioadas = array_diff($requestData['a005_id_empresa'], $userEmpresa_relacionadas);
            //dump(['$empresasNaoRelacioadas',$empresasNaoRelacioadas]);

            $userEmpresaInsert = Empresa::query()
                ->leftjoin('t004_empresa_usuario', function($join)use($id){
                    $join-> on('t004_empresa_usuario.a005_id_empresa','=','t005_empresa.a005_id_empresa');
                    $join->where('t004_empresa_usuario.a001_id_usuario', $id);
                })
                ->wherein('t005_empresa.a005_id_empresa',$requestData['a005_id_empresa'])
                ->wherenotin('t005_empresa.a005_id_empresa',$userEmpresa_relacionadas??[0])
                ->whereNull('t004_empresa_usuario.a005_id_empresa')
                ->select('t005_empresa.a005_id_empresa')
                ->pluck('a005_id_empresa')->values()->toArray();
            //dump(['userEmpresaInsert',$userEmpresaInsert]);

            //$usuario->Empresa_usuario_hasMany()->attach($userEmpresaInsert??[]);
            foreach ($userEmpresaInsert as $item) {
                $Empresa_usuario = new Empresa_usuario();
                $Empresa_usuario->a005_id_empresa = $item;
                $Empresa_usuario->a001_id_usuario = $id;
                if(Auth::user()->ind_super_adm<=0) {
                    $Empresa_usuario->a004_dono_cadastro = 1;
                }
                else {
                    $Empresa_usuario->a004_dono_cadastro = 0;
                }
                $Empresa_usuario->save();
            }


            Session::flash('flash_message', 'Usuário atualizado!');
            DB::commit();

            return redirect('usuario');

        } catch (\Exception $e) {
            DB::rollBack();
            //dd(['Exception',$e]);
            Session::flash('flash_message', 'Não foi possível atualizar o Usuário!');
            return redirect('usuario');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {


            Empresa_usuario::where('a001_id_usuario',$id)->delete();
            $user = User::where('a001_id_usuario' , $id)->first();
            Role_user::where('user_id',$user->id)->delete();
            $user->delete();
            Usuario::findOrFail($id)->delete();

            Session::flash('flash_message', 'Usuário excluído!');
            DB::commit();
            return redirect('usuario');

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('flash_message', 'Não foi possível excluir o Usuário!');
            return redirect('usuario');
        }
    }




    public function optionCidade($idEstado)
    {
        $ret = Cidade::query()
            ->where('a048_id_estado', '=', $idEstado ?? 0)
            ->orderby('a047_nome_cidade')
            ->pluck('a047_nome_cidade', 'a047_id_cidade')
            ->prepend('', '');
        return $ret;
    }

    public function optionEstado()
    {
        $ret = Estado::query()
            ->orderby('a048_nome_estado')
            ->pluck('a048_nome_estado', 'a048_id_estado')
            ->prepend('', '');
        return $ret;
    }


    public function listaPerfil()
    {
        $idsEmpresaUsuarioLogado = Empresa_usuario::query()
            ->where(function($where){
                $where->where('a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                $where->where('a004_dono_cadastro', 1);
            })
            ->pluck('a005_id_empresa')->toArray();

        $idPermissionUserLogado = Role_user::query()->where('user_id', Auth::user()->id)->pluck('role_id')->toArray();

        $role = Role::query()
            ->leftjoin('t004_empresa_usuario','t004_empresa_usuario.a005_id_empresa','=','roles.a005_id_empresa')
            ->leftjoin('role_user', 'role_user.role_id', '=','roles.id')
            ->where('status',1 )
            ->where(function($where) use($idsEmpresaUsuarioLogado,$idPermissionUserLogado){
                if(Auth::user()->ind_super_adm<=0) {
                    $where->where('t004_empresa_usuario.a001_id_usuario', Auth::user()->a001_id_usuario);
                    $where->wherein('roles.a005_id_empresa',$idsEmpresaUsuarioLogado );
                }
                $where->orwherein('role_user.role_id',$idPermissionUserLogado);
            })
            ->select('name','description','status','id', 'ind_super_adm', 'ind_adm', 'ind_cliente', 'ind_fornecedor')
            ->distinct()
            ->pluck('name','id');

        return $role;
    }

    public function listaEmpresa()
    {
        $empresa =  Empresa::query()
            ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
            ->where(function($where){
                if(Auth::user()->ind_super_adm<=0) {
                    $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                    $where->where('a004_dono_cadastro', 1);
                }
            })
            ->select('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')
            ->groupBy('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')
            ->addSelect(DB::RAW("concat(ifnull(a005_nome_fantasia,''),ifnull(a005_nome_completo,'')) as nome"))
            ->pluck('nome','t005_empresa.a005_id_empresa');

        return $empresa;
    }


}

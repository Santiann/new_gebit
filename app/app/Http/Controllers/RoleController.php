<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Empresa_usuario;
use App\Http\Controllers\_DefaultController as DefaultController;
use App\Http\Requests;
use App\Permission;
use App\User;
use App\Usuario;
use App\UsuarioRoles;
use Yajra\DataTables\DataTables;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Http\Controllers\Controller;
use Session;
use Auth;
use Entrust;

class RoleController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['permission:roles-show|roles-create|roles-edit|roles-delete']);
    }

    public function datatable(Request $request)
    {
        $edit = Entrust::can('roles-edit');
        $delete = Entrust::can('roles-delete');

        $idsEmpresaUsuarioLogado = Empresa_usuario::query()
            ->where(function($where){
                $where->where('a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                $where->where('a004_dono_cadastro', 1);
            })
            ->pluck('a005_id_empresa')->toArray();



        return Datatables::of(
            Role::query()
                ->leftjoin('t004_empresa_usuario','t004_empresa_usuario.a005_id_empresa','=','roles.a005_id_empresa')
                ->leftjoin('role_user', 'role_user.role_id', '=','roles.id')

                ->where(function($where) use($idsEmpresaUsuarioLogado){
                    // mostrar so os perfis que estao ligado com sua empresa, caso super adm mostrar tb os perfis fixos e os que estao relacionados com a empresa
                    if(Auth::user()->ind_super_adm<=0) {
                        $where->where('t004_empresa_usuario.a001_id_usuario', Auth::user()->a001_id_usuario);
                        $where->wherein('roles.a005_id_empresa',$idsEmpresaUsuarioLogado );
                        $where->where('a004_dono_cadastro', 1);

                    }
                    else
                    {
                        $where->wherein('roles.a005_id_empresa',$idsEmpresaUsuarioLogado );
                        $where->orwhere('roles.ind_super_adm',1 );
                        $where->orwhere('roles.ind_adm',1 );
                        $where->orwhere('roles.ind_cliente',1 );
                        $where->orwhere('roles.ind_fornecedor',1 );

                    }

                })
                ->select('name','description','status','id', 'ind_super_adm', 'ind_adm', 'ind_cliente', 'ind_fornecedor')->distinct()

        )
            ->addColumn('action', function ($row) use ($edit,$delete) {
                $acoes = "";
                if($edit){
                    $acoes .= '<a class="btn btn-xs btn-primary"  title="Editar Perfil" href="/role/'.$row->id.'/edit" ><span class="fa fa-edit" aria-hidden="true"></span></a> ';
                }

                if($delete){
                    if($row->ind_super_adm == 0 && $row->ind_adm == 0 && $row->ind_cliente == 0 && $row->ind_fornecedor == 0) {
                        $acoes .= '<form method="POST" action="/role/' . $row->id . '" style="display:inline">
                            <input name="_method" value="DELETE" type="hidden">
                            ' . csrf_field() . '
                            <button type="button" class="btn btn-xs btn-danger" title="Excluir Perfil " onclick="return ConfirmaExcluir(\'Confirma Excluir Perfil?\',this)">
                               <span class="fa fa-trash"></span>
                            </button>
                        </form>';
                    }
                }
                return $acoes;
            })
            ->editColumn('status', function ($status) {

                if (isset($status->status)) {
                    if ($status->status == '1') {
                        $labelStatus = '<span class="label label-success"><i class="glyphicon glyphicon-ok"></i> &ensp;Ativo </span>';
                        return $labelStatus;

                    } else {
                        $labelStatus = '<span class="label label-warning"><i class="glyphicon glyphicon-remove"></i> &ensp;Inativo </span>';
                        return $labelStatus;
                    }
                }
            })
            ->filterColumn('status', function ($query, $keyword) {
                $query->where(function ($where) use ($query, $keyword) {
                    if (strpos(strtoupper('Ativo'), strtoupper($keyword)) !== false) {
                        $where->orwhere('status', '1');
                    }
                    if (strpos(strtoupper('Inativo'), strtoupper($keyword)) !== false) {
                        $where->orwhere('status', '0');
                    }
                });
            })
            ->escapeColumns(['*'])
            ->make(true);
    }

    public function index(Request $request)
    {
        return view('sistema.role.index');
    }

    public function create()
    {
        $query = Permission::query()
            ->join('permission_role','permission_role.permission_id','=','permissions.id')
            ->join('role_user','role_user.role_id','=','permission_role.role_id')
            ->where('user_id',  Auth::user()->id)
            ->select('permissions.id','permissions.name','permissions.display_name','permissions.description','tipo', 'url', "idparent","ordem","icone","status")
            ->distinct()
        ;

        $permissions = $query->get();

        $permissionUser='';
        $permission_user =  $permissions->pluck('id')->toArray();
        foreach($permission_user as $id){
            $permissionUser.=$id.',';
        }
        $permissionUser = substr ($permissionUser,0,strlen($permissionUser)-1);

        $rolePermissions = [];

        $comboEmpresa = $this->optionEmpresa();

        $usuario = [];//Usuario::orderby("a001_nome")->pluck('a001_nome','a001_id_usuario');

        $usuarioSelected = "";



        $menusQuery = $this->queryMenu($permissionUser);


        return view('sistema.role.create', compact('comboEmpresa','usuario','usuarioSelected','menusQuery','rolePermissions','permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'a005_id_empresa' => 'required'
        ]);
        $requestData = $request->all();
        $requestData['created_at_user'] = Auth::user()->id;
        $requestData['display_name'] = $requestData['name'];
        $requestData['status'] = $requestData['status']??0;
        $requestData['ind_super_adm'] = $requestData['ind_super_adm']??0;
        $requestData['ind_adm'] = $requestData['ind_adm']??0;
        $requestData['ind_cliente'] = $requestData['ind_cliente']??0;
        $requestData['ind_fornecedor'] = $requestData['ind_fornecedor']??0;


        DB::beginTransaction();
        try {

            $role = Role::create($requestData);

            foreach (array_unique($requestData['a001_id_usuario']??[]) as $key => $value) {
                $usuario = User::where('a001_id_usuario',$value)->first();

                $User = new UsuarioRoles();
                $User->role_id = $role->id;
                $User->user_id = $usuario->id;
                $User->save();
            }

            if($request->input('permission') != null){
                foreach ($request->input('permission') as $key => $value) {
                    $role->attachPermission($value);
                }
            }


            Session::flash('flash_message', 'Perfil adicionado!');
            DB::commit();
            return redirect('role');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            Session::flash('flash_message', 'Não foi possível atualizar o Perfil!');
            return redirect('role');
        }
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        $comboEmpresa = $this->optionEmpresa();


        return view('sistema.role.show', compact('role','comboEmpresa'));
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);

        $query = Permission::query()
            ->leftjoin('permission_role','permission_role.permission_id','=','permissions.id')
            ->leftjoin('role_user','role_user.role_id','=','permission_role.role_id')
            ->where(function($where) use ($role){
                //caso nao seja alcum perfil fixo entao filtrar pelo que foi dado permissao ao usuario
                if(($role->ind_super_adm+$role->ind_adm+$role->ind_cliente+$role->ind_fornecedor)<=0)
                    $where->where('user_id',  Auth::user()->id);
            })
            //->where('user_id',  Auth::user()->id)
            ->select('permissions.id','permissions.name','permissions.display_name','permissions.description','tipo', 'url', "idparent","ordem","icone","status")
            ->distinct()
        ;

        $permissions = $query->get();

        $permissionUser='';
        $permission_user =  $permissions->pluck('id')->toArray();
        foreach($permission_user as $id_p){
            $permissionUser.=$id_p.',';
        }

        $permissionUser = substr ($permissionUser,0,strlen($permissionUser)-1);

        $comboEmpresa = $this->optionEmpresa();

        ///busca os usuarios da empresa, ou todos os usuarios caso seja algum perfil que seja os ind fixos
        $indRoleFixo = $role->ind_super_adm + $role->ind_adm + $role->ind_cliente + $role->ind_fornecedor;
        $id_empresa = $role->a005_id_empresa;
        $usuario =  $this->usuariosDaEmpresa($id_empresa, $indRoleFixo);



        $usuarioSelected =  Usuario::query()
            ->join('users','users.a001_id_usuario','=','t001_usuario.a001_id_usuario')
            ->join('role_user','users.id','role_user.user_id')
            ->where('role_user.role_id', $id)
            ->where('users.ativo', 1)
            ->get('t001_usuario.a001_id_usuario')
        ;

        $menusQuery = $this->queryMenu($permissionUser);

        $rolePermissions = DB::table("permission_role")->where("permission_role.role_id",$id)
            ->pluck('permission_role.permission_id','permission_role.permission_id')->toArray();

        return view('sistema.role.edit', compact('role','comboEmpresa','usuario','usuarioSelected','menusQuery','rolePermissions','permissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
        $requestData = $request->all();
        $requestData['updated_at_user'] = Auth::user()->id;
        $requestData['display_name'] = $requestData['name'];
        $requestData['status'] = $requestData['status']??0;
        $requestData['ind_super_adm'] = $requestData['ind_super_adm']??0;
        $requestData['ind_adm'] = $requestData['ind_adm']??0;
        $requestData['ind_cliente'] = $requestData['ind_cliente']??0;
        $requestData['ind_fornecedor'] = $requestData['ind_fornecedor']??0;

        DB::beginTransaction();
        try {

            $role = Role::findOrFail($id);

            $role->update($requestData);

            DB::table('role_user')->where('role_user.role_id',$id)->delete();
            foreach (array_unique($requestData['a001_id_usuario']??[]) as $key => $value) {
                $usuario = User::where('a001_id_usuario',$value)->first();

                $User = new UsuarioRoles();
                $User->role_id = $id;
                $User->user_id = $usuario->id;
                $User->save();

                ///verificando se os usuarios ligados a esse perfil tem acesso a somente esse perfil em caso de sim desativar o usuarios desse perfil

                $usuarioPerfil = UsuarioRoles::query('user_id', $usuario->id)->count();
                if($usuarioPerfil<=1)
                {
                    $usuario = User::findOrFail($usuario->id);
                    $usuario->ativo = 0;
                    $usuario->save();
                }

                //dump($usuarioPerfil);


            }

            DB::table("permission_role")->where("permission_role.role_id",$id)->delete();

            if($request->input('permission') != null){
                foreach ($request->input('permission') as $key => $value) {
                    $role->attachPermission($value);
                }
            }




            Session::flash('flash_message', 'Perfil atualizado!');
            DB::commit();
            return redirect('role');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e,'---');
            Session::flash('flash_message', 'Não foi possível atualizar o Perfil!');
            return redirect('role');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            Role::findOrFail($id)->delete();

            Session::flash('flash_message', 'Perfil excluído!');
            DB::commit();
            return redirect('role');

        } catch (\Exception $e) {

            DB::rollBack();
            Session::flash('flash_message', 'Não foi possível excluir o Perfil !');
            return redirect('role');
        }
    }

    private function optionEmpresa()
    {
        $ret =  Empresa::query()
            ->join('t004_empresa_usuario', 't004_empresa_usuario.a005_id_empresa', '=', 't005_empresa.a005_id_empresa')
            ->where('a005_status', 1)
            ->where('a005_ind_empresa', 1)
            ->where(function($where){
                if(Auth::user()->ind_super_adm<=0) {
                    $where->where('t004_empresa_usuario.a001_id_usuario', '=', Auth::user()->a001_id_usuario);
                    $where->where('t004_empresa_usuario.a004_dono_cadastro', '=', 1);
                }
            })
            ->select('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')
            ->groupBy('t005_empresa.a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao', 'a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status')
            ->addSelect(DB::RAW("concat(ifnull(a005_nome_fantasia,''),ifnull(a005_nome_completo,'')) as nome"))
            ->pluck('nome','t005_empresa.a005_id_empresa');

        if(count($ret)>1)
        {
            $ret->prepend('','');
        }
        return $ret;
    }



    public function usuarioEmpresa(Request $request)
    {
        $requestData = $request->all();

        $usuario = $this->usuariosDaEmpresa($requestData["id_empresa"], $requestData["indRoleFixo"]);

        return $usuario;
    }

    private function usuariosDaEmpresa($id_empresa, $indRoleFixo)
    {
        $usuario =  Usuario::query()
            ->join('t004_empresa_usuario','t004_empresa_usuario.a001_id_usuario','=','t001_usuario.a001_id_usuario')
            ->join('t005_empresa','t005_empresa.a005_id_empresa','=','t004_empresa_usuario.a005_id_empresa')
            ->where(function($where)use($id_empresa, $indRoleFixo){
                if($indRoleFixo<=0) {
                    $where->where('t004_empresa_usuario.a005_id_empresa', $id_empresa);
                }
            })
            ->where('t001_usuario.a001_status', 1)
            ->orderby("t001_usuario.a001_nome")
            ->select("t001_usuario.a001_id_usuario as id_usuario")
            ->addSelect(DB::RAW("case when ".$indRoleFixo.">0 then CONCAT(ifnull(t001_usuario.a001_nome,''),' (',ifnull(t005_empresa.a005_nome_completo,a005_nome_fantasia),')','') else t001_usuario.a001_nome end as nome"))
            ->pluck('nome','id_usuario');
            //->get();
        return $usuario;
    }

    public function queryMenu($permissionUser)
    {

        $menusQuery =  DB::raw("SELECT concat(
ifnull(t9.ordem,''),ifnull(t9.display_name,''),
ifnull(t8.ordem,''),ifnull(t8.display_name,''),
ifnull(t7.ordem,''),ifnull(t7.display_name,''),
ifnull(t6.ordem,''),ifnull(t6.display_name,''),
ifnull(t5.ordem,''),ifnull(t5.display_name,''),
ifnull(t4.ordem,''),ifnull(t4.display_name,''),
ifnull(t3.ordem,''),ifnull(t3.display_name,''),
ifnull(t2.ordem,''),ifnull(t2.display_name,''),
ifnull(t1.ordem,''),ifnull(t1.display_name,''),'')  nomes
,t1.display_name as lev1, t2.display_name as lev2, t3.display_name as lev3, t4.display_name as lev4, t5.display_name as lev5, t6.display_name as lev6, t7.display_name as lev7, t8.display_name as lev8, t9.display_name as lev9
,t1.id, t1.name, t1.display_name, t1.ordem, t1.idparent,t1.tipo, t1.description, t1.url
,concat(
case when t9.display_name <> '' then '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' else '' end,
case when t8.display_name <> '' then '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' else '' end,
case when t7.display_name <> '' then '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' else '' end,
case when t6.display_name <> '' then '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' else '' end,
case when t5.display_name <> '' then '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' else '' end,
case when t4.display_name <> '' then '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' else '' end,
case when t3.display_name <> '' then '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' else '' end,
case when t2.display_name <> '' then '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' else '' end,
'', t1.display_name)  display_nameEspacos
,concat(
case when t9.id <> '' then concat(' j',t9.id) else '' end,
case when t8.id <> '' then concat(' j',t8.id) else '' end,
case when t7.id <> '' then concat(' j',t7.id) else '' end,
case when t6.id <> '' then concat(' j',t6.id) else '' end,
case when t5.id <> '' then concat(' j',t5.id) else '' end,
case when t4.id <> '' then concat(' j',t4.id) else '' end,
case when t3.id <> '' then concat(' j',t3.id) else '' end,
case when t2.id <> '' then concat(' j',t2.id) else '' end,
'')  idclassFilhos
,concat(' j',t1.id) idclassPai
FROM permissions AS t1
LEFT JOIN permissions AS t2 ON t2.id = t1.idparent
LEFT JOIN permissions AS t3 ON t3.id = t2.idparent
LEFT JOIN permissions AS t4 ON t4.id = t3.idparent
LEFT JOIN permissions AS t5 ON t5.id = t4.idparent
LEFT JOIN permissions AS t6 ON t6.id = t5.idparent
LEFT JOIN permissions AS t7 ON t7.id = t6.idparent
LEFT JOIN permissions AS t8 ON t8.id = t7.idparent
LEFT JOIN permissions AS t9 ON t9.id = t8.idparent
where t1.tipo = 'menu'
AND t1.id IN (".$permissionUser.")
order by 1");

        $menusQuery = DB::select($menusQuery);

        return $menusQuery;

    }

}

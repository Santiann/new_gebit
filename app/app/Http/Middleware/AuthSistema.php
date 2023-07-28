<?php

namespace App\Http\Middleware;

//use App\Usuario;
use App\Empresa_usuario;
use App\Role;
use Closure;
use Auth;
use Session;
use Carbon\Carbon;


class AuthSistema
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user()->ativo) {
            // Session::flash('flash_message', 'Usuário Inativo!');
            // Auth::logout();
            return abort(403, 'Seu usuário está inativo.');
        }

        ///verifica se a empresa do usuario esta ativa

        $empresa_usuario = Empresa_usuario::query()
            ->join('t005_empresa','t005_empresa.a005_id_empresa','=','t004_empresa_usuario.a005_id_empresa')
            ->where('t004_empresa_usuario.a001_id_usuario',87)
            ->where('t005_empresa.a005_status','=',1)
            ->get()->count();


        if($empresa_usuario<=0)
        {
            // Session::flash('flash_message', 'Empresas desativada!');
            // Auth::logout();
            return abort(403, 'A empresa está desativada.');
        }

        //pega o id so ind_super_admin
        $roleind_super_adm =  Role::query()->where('ind_super_adm', 1)
            ->join('role_user', 'role_user.role_id', '=','roles.id')
            ->where('role_user.user_id',Auth::user()->id )
            ->first();
        $idPerfilind_super_admin = $roleind_super_adm->id??0;

        Auth::user()->ind_super_adm = $idPerfilind_super_admin;




            $idEmpresaPricipal = \App\Empresa::query()
                ->join('t004_empresa_usuario','t004_empresa_usuario.a005_id_empresa','=','t005_empresa.a005_id_empresa')
                ->where('a001_id_usuario', Auth::user()->a001_id_usuario)
                ->orderby('t005_empresa.a005_id_empresa')->first('t005_empresa.a005_id_empresa');

        Auth::user()->id_empresa_principal = $idEmpresaPricipal->a005_id_empresa??0;




        return $next($request);
    }
}

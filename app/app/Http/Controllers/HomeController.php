<?php

namespace App\Http\Controllers;

use App\Notificacao;
use App\Parametro;
use App\Permission;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if((Auth::user()->primeiro_acesso??0)==1)
        {
            $parametro = Parametro::query()
                ->where('a000_sigla','BOASVINDAS')
                ->first();

            //envia email de boas vindas
            $parametrosView['mensagem'] = $parametro->a000_valor;
            $this->enviaEmailPadraoView('sistema.email.aviso',$parametrosView,'Dealix','naoresponda@Dealix.com.br',Auth::user()->name,Auth::user()->email, 'BEM VINDO');

            $user = Auth::user();
            $user->primeiro_acesso = 0;
            $user->save();
        }

        return view('sistema.dashboard.dashboard');
    }
    public function dashboard()
    {
        if((Auth::user()->primeiro_acesso??0)==1)
        {
            $parametro = Parametro::query()
                ->where('a000_sigla','BOASVINDAS')
                ->first();

            //envia email de boas vindas
            $parametrosView['mensagem'] = $parametro->a000_valor;
            $this->enviaEmailPadraoView('sistema.email.aviso',$parametrosView,'Dealix','naoresponda@Dealix.com.br',Auth::user()->name,Auth::user()->email, 'BEM VINDO');

            $user = Auth::user();
            $user->primeiro_acesso = 0;
            $user->save();
        }

        return view('sistema.dashboard.dashboard');
    }

    public function notificacao()
    {
        return view('notificacao');
    }

    public function notificacaoLida(Request $request)
    {
        $id_notificacao = $request->idNotificacao;

        $notificacao = Notificacao::query()->where('a996_id_notificacao', $id_notificacao)->firstOrFail();
        $notificacao->a996_ind_lido = 1;
        $notificacao->save();
        return "1";
    }


}

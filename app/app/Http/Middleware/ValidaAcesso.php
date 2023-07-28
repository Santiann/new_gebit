<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Closure;
use App\Empresa_usuario;
use App\Role;
use Auth;
use Session;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User_site;
use App\Assinatura;

class ValidaAcesso
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
        $user_site = User_site::where('email', Auth::user()->email)->first();

        if (!$request->is('assinatura/*') && $user_site) {
            $assinatura = Assinatura::where('customer_id', $user_site->pagarme_customer_id)->first();

            if ($assinatura && !in_array($assinatura->status, ['paid', 'trialing'])) {
				return redirect()->to('/assinatura/'.$assinatura->status);
            }
        }
        
		return $next($request);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User_site;
use App\Assinatura;
use App\Plano;
use App\Http\Classes\Pagarme\Subscription;
use Auth;
use Session;

class AssinaturaController extends Controller
{
    public function assinatura($status = null)
    {
        $assinatura = $this->getAssinaturaByEmail(Auth::user()->email);
        $planos = Plano::all();

        try {
            $sub_pagarme = new Subscription();
            $subscription = $sub_pagarme->getSubscription($assinatura->id);
            $transactions = $sub_pagarme->getTransactions($assinatura->id);

            usort($transactions, function($a, $b) {
                return $a->date_updated <=> $b->date_updated;
            });
        } catch(\Exception $e){}

        return view('sistema.usuario.formAssinatura', compact('assinatura','status', 'planos', 'subscription', 'transactions'));
    }

    private function getAssinaturaByEmail($email)
    {
        $user = User_site::where('email', $email)->first();
        $assinatura = $user ? Assinatura::where('customer_id', $user->pagarme_customer_id)->first() : null;

        return $assinatura;
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['id'] = $id;

        $sub_pagarme = new Subscription();
        $sub_pagarme->updateSubscription($data);

        return \Redirect::back();
    }
}

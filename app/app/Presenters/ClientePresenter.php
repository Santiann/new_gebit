<?php  
namespace App\Presenters;

use Auth;

class ClientePresenter extends BasePresenter {

    public function nomeClienteCurto()
    {
            return explode(' ',trim($this->nome).' ')[0];
    }

    public function nomeCliente()
    {
        if(Auth::user()->colaborador->flagdados_cliente == "S")
            return trim($this->nome);
        else
            return explode(' ',trim($this->nome).' ')[0];
    }

    public function celularCliente()
    {
        if(Auth::user()->colaborador->flagdados_cliente == "S")
            return $this->celular;
        else
            return explode('-',$this->celular)[0]."-****";
    }
}
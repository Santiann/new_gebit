<?php  
namespace App\Presenters;

use Auth;

class AgendaPresenter extends BasePresenter {
    
    public function nomeClienteCurto()
    {
        if(isset($this->cliente->nome)){
            if(!is_null($this->cliente->nome))
                return explode(' ',trim($this->cliente->nome).' ')[0];
            else
                return "";            
        }
        else{
            return "";
        }
    }

    public function clienteNome()
    {
        if(isset($this->cliente->nome))
        {
            if(Auth::user()->colaborador->flagdados_cliente == "S")
                    return $this->cliente->nome;
            else
                return explode(' ',trim($this->cliente->nome).' ')[0];
        }
        else
        {
                return "";
        }
    }

    public function clienteCelular()
    {
        if(isset($this->cliente->nome))
        {
            if(Auth::user()->colaborador->flagdados_cliente == "S")
                return $this->cliente->celular;
            else
                return explode('-',$this->cliente->celular)[0]."-****";
        }
        else
        {
            return "";
        }
    }

    public function dtInicio()
    {
        if($this->dtini->timestamp > 0)
            return $this->dtini->format('d/m/Y');
        else
            return null;
    }

    public function datetimeLocalInicio()
    {
        if($this->dtini->timestamp > 0)
            return $this->dtini->format('Y-m-d\TH:i');
        else
            return null;
    }

    public function hrInicio()
    {
        if($this->dtini->timestamp > 0)
            return $this->dtini->format('H:i');
        else
            return null;
    }

    public function dtFinal()
    {
        if($this->dtfim->timestamp > 0)
            return $this->dtfim->format('d/m/Y');
        else
            return null;
    }

    public function datetimeLocalFinal()
    {
        if($this->dtfim->timestamp > 0)
            return $this->dtfim->format('Y-m-d\TH:i');
        else
            return null;
    }

    public function hrFinal()
    {
        if($this->dtfim->timestamp > 0)
            return $this->dtfim->format('H:i');
        else
            return null;
    }

    public function minutosAtendimento()
    {
        if($this->dtfim->timestamp > 0 && $this->dtini->timestamp)
            return $this->dtini->diffInMinutes($this->dtfim);
        else
            return 0;
    }

    public function espacosAgenda()
    {
        $periodos = ($this->minutosAtendimento() / $this->associadosagendas->minutos_intervalo);
        if($periodos < 0)
            return 1;
        else
            return $periodos;
    }

    public function qtdPeriodosIni(){
        $horaInicial  = \Carbon\Carbon::create($this->dtini->year, $this->dtini->month, $this->dtini->day, $this->associadosagendas->horaini, 0, 0);
        
        $qtd_periodos = $horaInicial->diffInMinutes($this->dtini) / $this->associadosagendas->minutos_intervalo;
        
        return $qtd_periodos;        
    }
    public function topRelative()
    {
        $qtd_periodos = $this->qtdPeriodosIni();
        if($qtd_periodos == 1)
            $top = 16;
        else
            $top = 16 + (($qtd_periodos-1)*16);

        return $top;
    } 

    public function bottomRelative()
    {
        $horaInicial  = \Carbon\Carbon::create($this->dtini->year, $this->dtini->month, $this->dtini->day, $this->associadosagendas->horaini, 0, 0);
        $qtd_periodos = $horaInicial->diffInMinutes($this->dtini) / $this->associadosagendas->minutos_intervalo;
        $bottom = ($this->topRelative()*-1) + (($this->dtini->diffInMinutes($this->dtfim) / $this->associadosagendas->minutos_intervalo) * -22);
        return $bottom;
    } 
}
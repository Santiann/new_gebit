<?php  
namespace App\Presenters;

class ColaboradorPresenter extends BasePresenter {

    public function statusDesc()
    {
    	$desc = $this->status;
    	if($this->status == 'AT')
    		$desc = "ATIVO";
    	if($this->status == 'IN')
    		$desc = "INATIVO";

        return $desc;
    }

}
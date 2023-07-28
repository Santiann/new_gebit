<?php  
namespace App\Presenters;

class DevPresenter extends BasePresenter {
    
    public function tipocampo()
    {
            if($this->DATA_TYPE == "bit")
                return "boolean";
            elseif($this->DATA_TYPE == "int")
                return "integer";
            elseif($this->DATA_TYPE == "varchar")
                return "string";
            else
                return $this->DATA_TYPE;            
            
    }
}
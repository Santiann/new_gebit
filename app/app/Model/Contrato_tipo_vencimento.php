<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato_tipo_vencimento extends Model
{


    protected $table = 't017_contrato_tipo_vencimento';

    //public $timestamps = false;

    protected $primaryKey = 'a017_id_vencimento';

    protected $fillable = ['a012_id_tipo_vencimento','a017_valor','a013_id_contrato','created_at_user','updated_at_user'];

    protected $hidden = [];

    protected $aliases = [
        'a012_id_tipo_vencimento' => 'Tipo Vencimento'
        ,'a017_valor' => 'Valor'
        ,'a013_id_contrato' => 'Id Contrato'
        ,'created_at_user' => 'created_at_user'
        ,'updated_at_user' => 'updated_at_user'
    ];

    public function getColumn(){
        return $this->fillable;
    }
    public function getAliases () {
        return $this->aliases;
    }

    public function Tipo_vencimento_belongsTo()
    {
        return $this->belongsTo('App\Tipo_vencimento');
    }
    public function Contrato_belongsTo()
    {
        return $this->belongsTo('App\Contrato');
    }

}

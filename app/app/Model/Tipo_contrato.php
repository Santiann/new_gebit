<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_contrato extends Model
{


    protected $table = 't010_tipo_contrato';

    //public $timestamps = false;



    protected $primaryKey = 'a010_id_tipo_contrato';

    protected $fillable = ['a010_id_tipo_contrato','a005_id_empresa','a010_descricao','a010_status','created_at_user','updated_at_user'];

    public function Empresa_belongsTo()
    {
        return $this->belongsTo('App\Empresa');
    }

}

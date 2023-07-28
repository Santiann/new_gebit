<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area_contrato extends Model
{
    

    protected $table = 't011_area_contrato';

    //public $timestamps = false;

    

    protected $primaryKey = 'a011_id_area';

    protected $fillable = ['a011_id_area','a005_id_empresa','a011_descricao','a011_status','created_at_user','updated_at_user'];

    public function Empresa_belongsTo()
    {
        return $this->belongsTo('App\Empresa');
    }
    
}

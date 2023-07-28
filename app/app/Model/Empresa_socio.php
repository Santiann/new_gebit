<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa_socio extends Model
{


    protected $table = 't007_empresa_socio';

    //public $timestamps = false;

    protected $primaryKey = 'a007_id_socio';

    protected $fillable = ['a007_id_socio','a007_nome','a007_percent_participacao','created_at_user','updated_at_user','a005_id_empresa'];

    public function Empresa_belongsTo()
    {
        return $this->belongsTo('App\Empresa');
    }

}

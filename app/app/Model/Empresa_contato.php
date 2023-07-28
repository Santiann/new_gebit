<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa_contato extends Model
{


    protected $table = 't006_empresa_contato';

    //public $timestamps = false;

    protected $primaryKey = 'a006_id_empresa_contato';

    protected $fillable = ['a006_id_empresa_contato','a005_id_empresa','a006_tipo_contato','a006_nome','a006_fone','a006_email','a006_status','created_at_user','updated_at_user','a005_id_empresa_criou'];

    public function Empresa_belongsTo()
    {
        return $this->belongsTo('App\Empresa');
    }

}

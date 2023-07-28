<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa_usuario extends Model
{


    protected $table = 't004_empresa_usuario';

    //public $timestamps = false;



    protected $primaryKey = 'a004_id_empresa_usuario';

    protected $fillable = ['a004_id_empresa_usuario','a001_id_usuario','a005_id_empresa','created_at_user','updated_at_user','a004_dono_cadastro'];

    public function Usuario_belongsTo()
    {
        return $this->belongsTo('App\Usuario', 'a001_id_usuario');
    }
    public function Empresa_belongsTo()
    {
        return $this->belongsTo('App\Empresa', 'a005_id_empresa');
    }

}

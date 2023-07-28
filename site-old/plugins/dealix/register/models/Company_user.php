<?php namespace Dealix\Register\Models;

use Model;

class Company_user extends Model
{
    protected $connection = 'mysql_system';
    
    protected $table = 't004_empresa_usuario';

    protected $primaryKey = 'a004_id_empresa_usuario';

    protected $fillable = ['a004_id_empresa_usuario','a001_id_usuario','a005_id_empresa','created_at_user','updated_at_user','a004_dono_cadastro'];


    // public function Usuario_belongsTo()
    // {
    //     return $this->belongsTo('App\Usuario');
    // }
    // public function Empresa_belongsTo()
    // {
    //     return $this->belongsTo('App\Empresa');
    // }
}

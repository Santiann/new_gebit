<?php namespace Dealix\Register\Models;

use Model;

class User extends Model
{
    protected $connection = 'mysql_system';

    protected $table = 't001_usuario';

    protected $primaryKey = 'a001_id_usuario';

    protected $fillable = ['a001_id_usuario','a001_nome','a001_email','a001_status','a001_cpf','a001_telefone','a001_cargo','a001_cep','a001_endereco','a001_numero_end','a047_id_cidade','a001_complemento','a001_bairro','created_at_user','updated_at_user','a001_foto'];


    public function getAuthUser()
    {
        return self::where('a001_email', \Auth::user()->email)->first();
    }

    // public function Empresa_usuario_hasMany()
    // {
    //     return $this->belongsToMany('App\Empresa_usuario','t004_empresa_usuario','a001_id_usuario','a005_id_empresa');
    // }

    // public function Cidade_belongsTo()
    // {
    //     return $this->belongsTo('App\Cidade');
    // }
}

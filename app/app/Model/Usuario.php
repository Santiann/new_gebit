<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{


    protected $table = 't001_usuario';

    //public $timestamps = false;



    protected $primaryKey = 'a001_id_usuario';

    protected $fillable = ['a001_id_usuario','a001_nome','a001_email','a001_status','a001_cpf','a001_telefone','a001_cargo','a001_cep','a001_endereco','a001_numero_end','a047_id_cidade','a001_complemento','a001_bairro','created_at_user','updated_at_user','a001_foto'];


    public function isCliente($contrato)
    {
        $id_empresas = $this->empresas->where('a005_ind_cliente')->pluck('a005_id_empresa')->toArray();

        return in_array($contrato->a005_id_empresa_cli_for, $id_empresas);
    }

    public function isFornecedor($id_contratante)
    {
        $id_empresas = $this->empresas->pluck('a005_id_empresa')->toArray();

        return !in_array($id_contratante, $id_empresas);
    }

    public function Empresa_usuario_hasMany()
    {
        return $this->belongsToMany('App\Empresa_usuario','t004_empresa_usuario','a001_id_usuario','a005_id_empresa');
    }

    public function empresas()
    {
        return $this->belongsToMany('App\Empresa','t004_empresa_usuario','a001_id_usuario','a005_id_empresa');
    }

    public function Cidade_belongsTo()
    {
        return $this->belongsTo('App\Cidade');
    }

    public function User_belongsTo()
    {
        return $this->belongsTo('App\User', 'a001_id_usuario', 'id');
    }
}

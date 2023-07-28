<?php namespace Dealix\Register\Models;

use Model;

class Company extends Model
{
    protected $connection = 'mysql_system';
    
    protected $table = 't005_empresa';

    protected $primaryKey = 'a005_id_empresa';

    protected $fillable = ['a005_id_empresa','a005_tipo_cliente','a005_logo','a005_tipo_empresa','a005_id_empresa_matriz','a005_ind_estrangeiro','a005_cod_identificacao','a005_ind_empresa','a005_ind_cliente','a005_ind_fornecedor','a005_cpf','a005_nome_completo','a005_cnpj','a005_razao_social','a005_nome_fantasia','a005_ie','a005_im','a005_fone','a005_email','a005_cep','a047_id_cidade','a005_endereco','a005_bairro','a005_numero_end','a005_complemento_end','a005_status','created_at_user','updated_at_user','a005_nome_cidade','a005_nome_estado'];
    

    // public function Empresa_usuario_hasMany()
    // {
    //     return $this->hasMany('App\Empresa_usuario');
    // }
    // public function Empresa_contato_hasMany()
    // {
    //     return $this->hasMany('App\Empresa_contato');
    // }
    // public function Empresa_socio_hasMany()
    // {
    //     return $this->hasMany('App\Empresa_socio');
    // }
    // public function Cidade_belongsTo()
    // {
    //     return $this->belongsTo('App\Cidade');
    // }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotacao extends Model
{


    protected $table = 't018_cotacao';

    //public $timestamps = false;

    protected $primaryKey = 'a018_id_contacao';

    protected $fillable = ['a005_id_empresa','a018_o_que','a018_descricao','a018_porque','a018_para_quem','a018_data_prevista','a018_status','a018_entrega','a018_forma_pagamento','a018_onde','a018_notificar','list_fornecedores','list_upload','a018_data_cotacao'];

    protected $aliases = [
        'a005_id_empresa' => 'Empresa'
        ,'a018_o_que' => 'O Que'
        ,'a018_descricao' => 'Descrição'
        ,'a018_porque' => 'Porque'
        ,'a018_para_quem' => 'Para Quem'
        ,'a018_data_prevista' => 'Data Prevista'
        ,'a018_entrega' => 'Entrega'
        ,'a018_forma_pagamento' => 'Forma de Pagamento'
        ,'a018_onde' => 'Onde'
        ,'a018_notificar' => 'Notificação'
        ,'a018_status' => 'Status'
        ,'list_fornecedores'=>'Fornecedores'
        ,'list_upload'=>'Arquivos'
        ,'created_at_user'=>'created_at_user'
        ,'updated_at_user'=>'updated_at_user'
        ,'a018_data_cotacao'=>'Data Cotação'
    ];

    public function getColumn()
    {
        return $this->fillable;
    }
    public function getAliases () {
        return $this->aliases;
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotacao_fornecedor extends Model
{


    protected $table = 't020_cotacao_fornecedor';

    //public $timestamps = false;



    protected $primaryKey = 'a020_id_cotacao_fornecedor';

    protected $fillable = ['a018_id_contacao','a005_id_empresa','a020_email_outro_fornecedor','a020_data_entrega','a020_valor','a020_obs','a020_status'];



    protected $aliases = [
        'a018_id_contacao' => 'Contrato'
        ,'a005_id_empresa' => 'Fornecedor'
        ,'a020_email_outro_fornecedor' => 'Email'
        ,'a020_data_entrega' => 'Data Entrega'
        ,'a020_valor' => 'Quanto'
        ,'a020_obs' => 'Obs'
        ,'a020_status' => 'Status'
        ,'created_at_user' => 'created_at_user'
        ,'updated_at_user' => 'updated_at_user'
    ];

    public function getColumn()
    {
        return $this->fillable;
    }
    public function getAliases () {
        return $this->aliases;
    }

    public function Empresa_belongsTo()
    {
        return $this->belongsTo('App\Empresa');
    }
    public function Cotacao_belongsTo()
    {
        return $this->belongsTo('App\Cotacao');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato_documento extends Model
{


    protected $table = 't014_contrato_documento';

    //public $timestamps = false;

    protected $primaryKey = 'a014_id_documento';

    protected $fillable = ['a014_documento','a014_data','a014_data_vencimento','a014_obs','a009_id_cat_contr_doc','a013_id_contrato','created_at_user','updated_at_user'];




    protected $aliases = [
        'a014_documento' => 'Documento'
        ,'a014_data' => 'Inclusão'
        ,'a014_data_vencimento' => 'Vencimento'
        ,'a014_obs' => 'Observação'
        ,'a009_id_cat_contr_doc' => 'Id Categoria'
        ,'a013_id_contrato' => 'Id Contrato'
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

    public function Contrato_belongsTo()
    {
        return $this->belongsTo('App\Contrato', 'a013_id_contrato');
    }

}

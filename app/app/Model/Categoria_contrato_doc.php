<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria_contrato_doc extends Model
{
    

    protected $table = 't009_categoria_contrato_doc';

    //public $timestamps = false;

    

    protected $primaryKey = 'a009_id_cat_contr_doc';

    protected $fillable = ['a009_id_cat_contr_doc','a008_id_cat_contrato','a009_descricao','a009_ind_obrigatorio','a009_dias_alerta_vencimento','a009_status','created_at_user','updated_at_user'];

    public function Categoria_contrato_belongsTo()
    {
        return $this->belongsTo('App\Categoria_contrato');
    }
    
}

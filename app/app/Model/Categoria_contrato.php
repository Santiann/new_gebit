<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria_contrato extends Model
{
    

    protected $table = 't008_categoria_contrato';

    //public $timestamps = false;

    

    protected $primaryKey = 'a008_id_cat_contrato';

    protected $fillable = ['a008_id_cat_contrato','a005_id_empresa','a008_descricao','a008_termo_cancelamento','a008_status','created_at_user','updated_at_user'];

    public function Categoria_contrato_doc_hasMany()
    {
        return $this->hasMany('App\Categoria_contrato_doc');
    }
    public function Empresa_belongsTo()
    {
        return $this->belongsTo('App\Empresa');
    }
    public function Contrato_belongsTo()
    {
        return $this->belongsToMany('App\Contrato', 't024_relacao_categorias_contrato', 'a008_id_cat_contrato', 'a013_id_contrato');
    }
}

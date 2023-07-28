<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_vencimento extends Model
{
    

    protected $table = 't012_tipo_vencimento';

    //public $timestamps = false;

    

    protected $primaryKey = 'a012_id_tipo_vencimento';

    protected $fillable = ['a012_id_tipo_vencimento','a005_id_empresa','a012_descricao','a012_status','created_at_user','updated_at_user'];

    public function Empresa_belongsTo()
    {
        return $this->belongsTo('App\Empresa');
    }
    
}

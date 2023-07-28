<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    

    protected $table = 't048_estado';

    //public $timestamps = false;

    

    protected $primaryKey = 'a048_id_estado';

    protected $fillable = ['a048_id_estado','a048_nome_estado','a048_uf','a049_id_pais','created_at_user','updated_at_user'];

    public function Cidade_hasMany()
    {
        return $this->hasMany('App\Cidade');
    }
    public function Pais_belongsTo()
    {
        return $this->belongsTo('App\Pais');
    }
    
}

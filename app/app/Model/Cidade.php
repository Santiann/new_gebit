<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    

    protected $table = 't047_cidade';

    //public $timestamps = false;

    

    protected $primaryKey = 'a047_id_cidade';

    protected $fillable = ['a047_id_cidade','a047_nome_cidade','a048_id_estado','created_at_user','updated_at_user','a049_id_pais'];

    public function Empresa_hasMany()
    {
        return $this->hasMany('App\Empresa');
    }
    public function Estado_belongsTo()
    {
        return $this->belongsTo('App\Estado');
    }
    public function Pais_belongsTo()
    {
        return $this->belongsTo('App\Pais');
    }
    
}

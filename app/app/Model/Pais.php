<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    

    protected $table = 't049_pais';

    //public $timestamps = false;

    

    protected $primaryKey = 'a049_id_pais';

    protected $fillable = ['a049_id_pais','a049_nome_pais','created_at_user','updated_at_user'];

    public function Cidade_hasMany()
    {
        return $this->hasMany('App\Cidade');
    }
    public function Estado_hasMany()
    {
        return $this->hasMany('App\Estado');
    }
    
}

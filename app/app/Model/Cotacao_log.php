<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotacao_log extends Model
{
    

    protected $table = 't021_cotacao_log';

    //public $timestamps = false;

    

    protected $primaryKey = 'a021_id_cotacao_log';

    protected $fillable = ['a021_id_cotacao_log','a018_id_contacao','a021_data_alteracao','a001_id_usuario','a021_log','created_at_user','updated_at_user'];

    public function Cotacao_belongsTo()
    {
        return $this->belongsTo('App\Cotacao');
    }
    
}

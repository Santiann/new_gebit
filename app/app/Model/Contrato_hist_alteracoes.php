<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato_hist_alteracoes extends Model
{
    

    protected $table = 't016_contrato_hist_alteracoes';

    //public $timestamps = false;

    

    protected $primaryKey = 'a016_id_historico';

    protected $fillable = ['a016_id_historico','a013_id_contrato','a016_data_alteracao','a001_id_usuario','a016_log','created_at_user','updated_at_user'];

    public function Usuario_belongsTo()
    {
        return $this->belongsTo('App\Usuario');
    }
    public function Contrato_belongsTo()
    {
        return $this->belongsTo('App\Contrato');
    }
    
}

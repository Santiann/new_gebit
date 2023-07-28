<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato_hist_renovacao extends Model
{
    

    protected $table = 't015_contrato_hist_renovacao';

    //public $timestamps = false;

    

    protected $primaryKey = 'a015_id_historico';

    protected $fillable = ['a015_id_historico','a015_data_renovacao','a013_id_contrato','a001_id_usuario','a015_nome_usuario','a015_data_inicio','a015_dias','a015_data_fim','a015_valor_total_contrato','a015_obs','created_at_user','updated_at_user'];

    public function Usuario_belongsTo()
    {
        return $this->belongsTo('App\Usuario');
    }
    public function Contrato_belongsTo()
    {
        return $this->belongsTo('App\Contrato');
    }
    
}

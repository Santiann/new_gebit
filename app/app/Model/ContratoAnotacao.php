<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContratoAnotacao extends Model
{
    protected $table = 't026_contrato_anotacoes';

    public $timestamps = true;

    protected $primaryKey = 'a026_id_anotacao';

    protected $fillable = [
        'a013_id_contrato',
        'a001_id_usuario',
        'a026_anotacao_titulo',
        'a026_nome_usuario',
        'a026_anotacao_descricao',
        'a026_anotacao_obs',
        'a026_anotacao_aceite',
        'a028_id_contrato_financeiro',
    ];

    public function Usuario_belongsTo()
    {
        return $this->belongsTo('App\Usuario', 'a001_id_usuario');
    }
    public function Contrato_belongsTo()
    {
        return $this->belongsTo('App\Contrato');
    }
}

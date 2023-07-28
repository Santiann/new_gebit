<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Usuario;

class ContratoFinanceiro extends Model
{
    protected $table = 't028_contrato_financeiro';

    public $timestamps = true;

    protected $primaryKey = 'a028_id_contrato_financeiro';

    protected $fillable = [
        'a013_id_contrato',
        'a005_id_empresa',
        'a028_valor_fracao',
        'a028_recorrencia',
        'a028_valor_comissao',
        'a028_valor_extra',
        'a028_valor_total_contrato',
        'a028_justificativa',
        'a028_status',
        'a028_data_cobranca',
        'a028_documento',
        'a028_created_by_email',
    ];

    public static function getUsuarioPendencias($user_id)
    {
        $id_empresas = Usuario::find($user_id)->empresas->pluck('a005_id_empresa')->toArray();

        return ContratoPendencia::whereIn('a005_id_empresa', $id_empresas)->where(function($query) {
                $query->whereNull('a027_pendencia_aceite')
                    ->orWhereNotIn('a027_pendencia_aceite', [1]);
            })->with('Empresa_belongsTo')->get();
    }

    public function Usuario_belongsTo()
    {
        return $this->belongsTo('App\Usuario', 'a001_id_usuario');
    }
    public function Contrato_belongsTo()
    {
        return $this->belongsTo('App\Contrato');
    }
    public function Empresa_belongsTo()
    {
        return $this->belongsTo('App\Empresa', 'a005_id_empresa');
    }
    public function Email_hasMany()
    {
        return $this->hasMany('App\Email', 'a028_id_contrato_financeiro');
    }
}

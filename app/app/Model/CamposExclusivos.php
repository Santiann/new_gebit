<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CamposExclusivos extends Model
{
    protected $table = 't030_campos_exclusivos';

    protected $primaryKey = 'a030_id_campo';

    protected $fillable = [
        'a030_id_campo',
        'a030_secao',
        'a030_identificador',
        'a030_valor_identificador',
        'a030_campo',
        'a030_valor',
        'a005_id_empresa',
    ];

    protected $campos_visiveis = [
        'a013_finalidade_fornecedor',
        'a013_finalidade_cliente',
        'a013_referencia_cliente',
        'a013_referencia_fornecedor',
        'a013_obs_contrato_cliente',
        'a013_obs_contrato_fornecedor',
    ];

    public function scopeContrato($query, $id_contrato, $id_empresas, $apenas_visiveis = false)
    {
        $query = $query->where('a030_secao', 'contratos')
                ->where('a030_identificador', 'a013_id_contrato')
                ->where('a030_valor_identificador', $id_contrato)
                ->whereIn('a005_id_empresa', $id_empresas);

        return $apenas_visiveis ? $query->whereIn('a030_campo', $this->campos_visiveis) : $query;
    }
}

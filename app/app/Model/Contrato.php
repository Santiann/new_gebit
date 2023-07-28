<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contrato extends Model
{
    use SoftDeletes;
    
    protected $table = 't013_contrato';

    protected $primaryKey = 'a013_id_contrato';

    protected $fillable = ['a013_valor_extra_referencia','a013_moeda','a013_empresa_contratante','a013_usuarios_acesso', 'a013_referencia_interna', 'a013_recorrencia','a005_id_empresa','a005_id_empresa_cli_for','a010_id_tipo_contrato','a011_id_area','a013_numero_contrato','a013_classificacao','a013_finalidade','a013_prazo_contrato','a013_data_inicio','a013_data_fim','a013_dias_vencimento','a013_valor_total_contrato', 'a013_valor_fracao', 'a013_valor_extra','a013_valor_comissao','a013_periodicidade_reajuste','a013_indice_reajuste','a013_prazo_recisao','a013_custo_recisao_antecipada','a013_obs_custo_revisao_antec','a013_conta_contabil','a013_centro_custo','a001_id_usuario','a013_obs_contrato','a013_assinatura','a013_status','a013_data_cancelado','a013_aceita_termo','a001_id_usuario_cancelou','a013_id_contrato_original','list_documentos', 'list_vencimentos' , 'created_at_user','updated_at_user', 'a013_data_renovacao'];

    protected $aliases = [
        'a013_id_contrato'=>'Contrato',
        'a005_id_empresa'=>'Empresa',
        'a013_moeda'=>'Moeda',
        'a005_id_empresa_cli_for'=>'Cliente Fornecedor',
        'a008_id_cat_contrato'=>'Categoria Contrato',
        'a010_id_tipo_contrato'=>'Tipo Contrato',
        'a011_id_area'=>'Área',
        'a013_numero_contrato'=>'Número Contrato',
        'a013_classificacao'=>'Classificação',
        'a013_finalidade'=>'Finalidade',
        'a013_prazo_contrato'=>'Prazo Contrato',
        'a013_data_inicio'=>'Data Ínicio',
        'a013_data_fim'=>'Data Fim',
        'a013_data_renovacao'=>'Data Renovação',
        'a013_dias_vencimento'=>'Dias vencimento',
        'a013_valor_fracao'=>'Valor fração',
        'a013_valor_total_contrato'=>'Valor total contrato',
        'a013_valor_extra'=>'Valor extra',
        'a013_valor_extra_referencia'=>'Referência do valor extra',
        'a013_valor_comissao'=>'Valor comissão',
        'a013_periodicidade_reajuste'=>'Periodicidade reajuste',
        'a013_indice_reajuste'=>'Índice reajuste',
        'a013_prazo_recisao'=>'Prazo recisão',
        'a013_custo_recisao_antecipada'=>'Custo recisão Antecipada',
        'a013_obs_custo_revisao_antec'=>'Obs custo revisão antecipada',
        'a013_conta_contabil'=>'Conta contabil',
        'a013_centro_custo'=>'Centro custo',
        'a001_id_usuario'=>'Responsável',
        'a013_obs_contrato'=>'obs contrato',
        'a013_assinatura'=>'assinatura',
        'a013_status'=>'status',
        'a013_data_cancelado'=>'data cancelado',
        'a013_aceita_termo'=>'aceitou termo Cancelamento',
        'a001_id_usuario_cancelou'=>'usuario cancelou',
        'a013_id_contrato_original'=>'Contrato Relacionado',
        'list_documentos'=>'Documentos',
        'list_vencimentos'=>'Vencimentos',
        'created_at_user'=>'created_at_user',
        'updated_at_user'=>'updated_at_user',
        'updated_at'=>'updated_at',
        'a013_referencia_interna' => 'Referência interna',
    ];

    protected $hideColumns = ['a008_id_cat_contrato', 'a011_id_area', 'a013_finalidade', 'a013_conta_contabil', 'a013_centro_custo',
        'a001_id_usuario', 'a013_referencia_interna', 'updated_at', 'created_at', 'created_at_user', 'updated_at_user', 'a013_usuarios_acesso'];

    public function getHideColumns()
    {
        return $this->hideColumns;
    }

    public function getColumn()
    {
        return array_diff($this->fillable, $this->hideColumns);
    }
    public function getAliases () {
        return $this->aliases;
    }


    public function Contrato_documento_hasMany()
    {
        return $this->hasMany('App\Contrato_documento', 'a013_id_contrato');
    }
    public function Contrato_hist_renovacao_hasMany()
    {
        return $this->hasMany('App\Contrato_hist_renovacao');
    }
    public function Contrato_hist_alteracoes_hasMany()
    {
        return $this->hasMany('App\Contrato_hist_alteracoes');
    }
    public function Contrato_tipo_vencimento_hasMany()
    {
        return $this->hasMany('App\Contrato_tipo_vencimento');
    }
    public function Usuario_belongsTo()
    {
        return $this->belongsTo('App\Usuario', 'a001_id_usuario');
    }
    public function Empresa_belongsTo()
    {
        return $this->belongsTo('App\Empresa', 'a005_id_empresa', 'a005_id_empresa');
    }
    public function Empresa_CliFor_belongsTo()
    {
        return $this->belongsTo('App\Empresa', 'a005_id_empresa_cli_for', 'a005_id_empresa');
    }
    public function Categoria_contrato_belongsTo()
    {
        return $this->belongsToMany('App\Categoria_contrato', 't024_relacao_categorias_contrato', 'a013_id_contrato', 'a008_id_cat_contrato')->withPivot('a005_id_empresa');
    }
    public function Tipo_contrato_belongsTo()
    {
        return $this->belongsTo('App\Tipo_contrato');
    }
    public function Area_contrato_belongsTo()
    {
        return $this->belongsTo('App\Area_contrato');
    }
    public function Contrato_contato_hasMany()
    {
        return $this->hasMany('App\Contrato_contato', 'a013_id_contrato');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compromisso extends Model
{
    

    protected $table = 't022_compromisso';

    //public $timestamps = false;

    

    protected $primaryKey = 'a022_id_compromisso';

    protected $fillable = ['a022_data_inicio','a022_data_fim','a022_recorrencia','a022_categorias', 'a022_tipo','a022_id_compromisso','a005_id_empresa','a013_id_contrato','a005_id_empresa_cli_for','a022_classificacao','a022_finalidade','a022_data_vencimento','a022_valor_pagar','a022_uso_vital','a022_data_pagamento','a022_valor_pago','a022_forma_pagamento','a022_status','created_at_user','updated_at_user'];

    public function Compromisso_upload_hasMany()
    {
        return $this->hasMany('App\Compromisso_upload');
    }
    public function Empresa_belongsTo()
    {
        return $this->belongsTo('App\Empresa', 'a005_id_empresa');
    }
    public function Empresa_Cli_For_belongsTo()
    {
        return $this->belongsTo('App\Empresa', 'a005_id_empresa_cli_for');
    }
    public function Contrato_belongsTo()
    {
        return $this->belongsTo('App\Contrato', 'a013_id_contrato');
    }
    
}

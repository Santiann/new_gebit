<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa_documento extends Model
{


    protected $table = 't025_empresa_documentos';

    public $timestamps = true;

    protected $primaryKey = 'a025_id_documento';

    protected $fillable = ['*'];

    protected $aliases = [
        'a025_documento' => 'Documento'
        ,'a025_obs' => 'Observação'
        ,'a025_id_empresa' => 'Id Empresa'
        ,'created_at_user' => 'created_at_user'
        ,'updated_at_user' => 'updated_at_user'
    ];

    public function getColumn()
    {
        return $this->fillable;
    }
    public function getAliases () {
        return $this->aliases;
    }

    public function Empresa_belongsTo()
    {
        return $this->belongsTo('App\Empresa', 'a005_id_empresa');
    }

}

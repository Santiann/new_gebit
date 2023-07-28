<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato_contato extends Model
{
    protected $table = 't029_contrato_contato';

    protected $primaryKey = 'a029_id_contrato_contato';

    protected $fillable = ['a029_id_contrato_contato','a013_id_contrato','a029_tipo_contato','a029_nome','a029_email','a029_fone','a029_status','created_at_user','updated_at_user'];


    public function Contrato_belongsTo()
    {
        return $this->belongsTo('App\Contrato');
    }

    public function Usuario_createdBy()
    {
        return $this->belongsTo('App\Usuario', 'created_at_user');
    }
}

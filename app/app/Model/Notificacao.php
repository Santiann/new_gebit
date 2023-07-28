<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{


    protected $table = 't996_notificacao';

    //public $timestamps = false;



    protected $primaryKey = 'a996_id_notificacao';

    protected $fillable = ['a996_id_notificacao','a001_id_usuario','a996_assunto','a996_conteudo','a996_ind_lido','a996_nome_icone','created_at_user','updated_at_user'];

    public function Usuario_belongsTo()
    {
        return $this->belongsTo('App\Usuario');
    }

}

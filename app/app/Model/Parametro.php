<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{


    protected $table = 't000_parametro';



    protected $primaryKey = 'a000_id_parametro';

    protected $fillable = ['a000_id_parametro','a000_sigla','a000_nome','a000_descricao','a000_valor','a000_status','created_at_user','updated_at_user','a000_ind_adm'];


}

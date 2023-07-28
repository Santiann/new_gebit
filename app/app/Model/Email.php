<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 't997_email';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'a997_id_email';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['a997_id_email', 'a997_de_nome', 'a997_de_email', 'a997_para_nome', 'a997_para_email', 'a997_assunto', 'a997_conteudo', 'a997_IP_visualizado', 'a028_id_contrato_financeiro', 'a997_email_visualizado'];

    
}

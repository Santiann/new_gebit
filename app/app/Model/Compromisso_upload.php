<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compromisso_upload extends Model
{


    protected $table = 't023_compromisso_upload';

    //public $timestamps = false;



    protected $primaryKey = 'a023_id_comprom_upload';

    protected $fillable = ['a023_id_comprom_upload','a022_id_compromisso','a023_descricao','a023_url','created_at_user','updated_at_user'];

    public function Compromisso_belongsTo()
    {
        return $this->belongsTo('App\Compromisso');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotacao_upload extends Model
{


    protected $table = 't019_cotacao_upload';

    //public $timestamps = false;



    protected $primaryKey = 'a019_id_upload';

    protected $fillable = ['a018_id_contacao','a019_url'];

    protected $aliases = [
        'a019_url' => "Arquivo"
        ,'a018_id_contacao' => "Cotação"
        ,'created_at_user' => "created_at_user"
        ,'updated_at_user' => "updated_at_user"
    ];

    public function getColumn()
    {
        return $this->fillable;
    }
    public function getAliases () {
        return $this->aliases;
    }

    public function Cotacao_belongsTo()
    {
        return $this->belongsTo('App\Cotacao');
    }

}

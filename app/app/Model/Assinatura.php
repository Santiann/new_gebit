<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assinatura extends Model
{
    protected $connection = "mysql_site";

    protected $table = 'dealix_planos_assinaturas';

    public function scopeIsActive($query)
    {
        return $query->where('status', '!=', 'canceled');
    }
}

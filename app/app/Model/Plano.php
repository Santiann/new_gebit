<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    protected $connection = "mysql_site";

    protected $table = 'dealix_planos_planos';

    public function scopeIsActive($query)
    {
        return $query->where('publicado', true);
    }
}

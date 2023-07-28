<?php namespace Dealix\Register\Models;

use Model;

/**
 * Country Model
 */
class Country extends Model
{
    protected $connection = 'mysql_system';

    protected $table = 't049_pais';

    protected $primaryKey = 'a049_id_pais';

    protected $fillable = ['a049_id_pais','a049_nome_pais','created_at_user','updated_at_user'];

    public $hasMany = [
        'states' => ['Dealix\Register\Models\State', 'key' => 'a049_id_pais'],
    ];
}

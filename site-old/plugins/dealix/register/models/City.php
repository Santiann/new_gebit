<?php namespace Dealix\Register\Models;

use Model;

/**
 * City Model
 */
class City extends Model
{
    protected $connection = 'mysql_system';

    protected $table = 't047_cidade';

    protected $primaryKey = 'a047_id_cidade';

    protected $fillable = ['a047_id_cidade','a047_nome_cidade','a048_id_estado','created_at_user','updated_at_user','a049_id_pais'];

    // public function companies()
    // {
    //     return $this->hasMany('App\Company');
    // }

    public $belongsTo = [
        'state' => ['Dealix\Register\Models\State', 'key' => 'a048_id_estado'],
    ];
}

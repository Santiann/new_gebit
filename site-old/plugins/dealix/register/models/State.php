<?php namespace Dealix\Register\Models;

use Model;

/**
 * State Model
 */
class State extends Model
{
    protected $connection = 'mysql_system';
    /**
     * @var string The database table used by the model.
     */
    public $table = 't048_estado';

    protected $primaryKey = 'a048_id_estado';
    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    protected $rules = [];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['a048_id_estado','a048_nome_estado','a048_uf','a049_id_pais','created_at_user','updated_at_user'];

    public $hasMany = [
        'cities' => ['Dealix\Register\Models\City', 'key' => 'a048_id_estado'],
    ];

    public $belongsTo = [
        'country' => ['Dealix\Register\Models\Country', 'key' => 'a048_id_estado'],
    ];
}

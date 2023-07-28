<?php namespace Dealix\Register\Models;

use Model;

class UserRoles extends Model
{
    protected $connection = 'mysql_system';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'role_user';

    public $timestamps = false;

    /**
    * The database primary key value.
    *
    * @var string
    */
    // protected $primaryKey = 'user';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [ 'user_id','role_id'];
}

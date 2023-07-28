<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioRoles extends Model
{
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

<?php namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description', 'created_at_user', 'updated_at_user', 'tipo', 'url', 'idmodulo', 'idparent', 'ordem', 'icone','status'];



    /**
     * join
     */
    public function menupai()
    {
        return $this->belongsTo('App\Permission','idparent','id');
    }
}

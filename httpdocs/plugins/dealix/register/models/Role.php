<?php namespace Dealix\Register\Models;

use Model;

class Role extends Model
{
    protected $connection = 'mysql_system';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id','name','display_name','description','a005_id_empresa','status','ind_super_adm','ind_adm','ind_cliente','ind_fornecedor'];

    // public function Empresa_belongsTo()
    // {
    //     return $this->belongsTo('App\Empresa');
    // }
}

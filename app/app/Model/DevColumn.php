<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class DevColumn extends Model
{
    use PresentableTrait;
    protected $presenter = \App\Presenters\DevPresenter::class;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'information_schema.columns';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'table_name';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['table_catalog','table_schema', 'table_name', 'column_name', 'data_type', 'is_nullable', 'column_type', 'ordinal_position', 'column_key', ];
}
<?php namespace Dealix\Planos\Models;

use Model;

/**
 * Assinatura Model
 */
class Assinatura extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'dealix_planos_assinaturas';

    public $timestamps = false;

    /**
     * @var array Guarded fields
     */
    protected $guarded = [];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'plano' => ['Dealix\Planos\Models\Plano', 'key' => 'plan_id', 'otherKey' => 'pagarme_id']
    ];
}

<?php namespace Dealix\Planos\Models;

use Dealix\Pagarme\Models\Settings;

use \Model;

/**
 * Model para controlar os Recursos cadastrados pelo sistema
 * Class Recurso
 * @package Dealix\Planos\Models
 */
class Plano extends Model
{
    use \October\Rain\Database\Traits\Validation;

    // Prop para configurar de qual tabela estamos falando
    public $table       = 'dealix_planos_planos';

    //Regras de valida��o
    public $rules           = [
        'nome'                => 'required',
        'valor'                => 'required',
    ];

    // E quem se relaciona com ela.
    public $attachMany   = [
        'imagens'  => ['System\Models\File']
    ];

    public $jsonable = [
        'features'
    ];

    public function scopeIsPublished($query)
    {
        $query->where('publicado', true);
    }

    public function filterFields($fields, $context = null)
    {
        if ($context == 'update') {
            $fields->valor->readOnly = true;
            $fields->is_monthly->readOnly = true;
        }
    }

    public function beforeCreate()
    {
        $pagarme = new \PagarMe\Client(Settings::get('api_key'));
        $amount = str_replace('.', '', $this->valor);
        $days = $this->is_monthly ? '30' : '365';

        $plan = $pagarme->plans()->create([
            'amount' => $amount,
            'days' => $days,
            'name' => $this->nome,
            // 'trial_days' => $this->free_trial_days
        ]);

        $this->pagarme_id = $plan->id;
    }

    public function beforeUpdate()
    {
        $pagarme = new \PagarMe\Client(Settings::get('api_key'));

        $updatedPlan = $pagarme->plans()->update([
            'id' => $this->pagarme_id,
            'name' => $this->name,
            // 'trial_days' => (int) $this->free_trial_days
        ]);
    }

    /**
     * @var array Relations
     */
    public $hasMany = [
        'assinatura' => ['Dealix\Planos\Models\Assinatura', 'key' => 'pagarme_id', 'otherKey' => 'plan_id']
    ];
}

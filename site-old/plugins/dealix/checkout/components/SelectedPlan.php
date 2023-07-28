<?php namespace Dealix\Checkout\Components;

use Cms\Classes\ComponentBase;
use Dealix\Planos\Models\Plano;

class SelectedPlan extends ComponentBase
{
    public $selected_plan;

    public function componentDetails()
    {
        return [
            'name'        => 'SelectedPlan Component',
            'description' => 'Selected plan to buy'
        ];
    }

    public function defineProperties()
    {
        return [];
    }
    
    public function onRun()
    {
        $plan_id = $this->param('plan_id');
        $this->selected_plan = Plano::where('pagarme_id', $plan_id)->first();
    }
}

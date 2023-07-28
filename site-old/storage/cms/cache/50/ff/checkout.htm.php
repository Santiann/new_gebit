<?php 
class Cms612606d5d2985142634966_a1fcfc8cd03fcbfb359da6d1bc63a3d7Class extends Cms\Classes\PageCode
{
public function onStart()
{
    $plan_id = $this->param('plan_id');
    $plan = \Dealix\Planos\Models\Plano::where('pagarme_id', $plan_id)->first();

    if (!$plan) {
        return \Redirect::to('pricing');
    }
}
}

<?php namespace Dealix\Planos\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Dealix\Pagarme\Classes\Subscription;
use Dealix\Planos\Widgets\ListTransactions;

/**
 * Assinaturas Back-end Controller
 */
class Assinaturas extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    /**
     * @var string Configuration file for the `FormController` behavior.
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string Configuration file for the `ListController` behavior.
     */
    public $listConfig = 'config_list.yaml';

    private $subPagarMe;

    private $subId;

    public function __construct()
    {
        parent::__construct();

        if ($this->params) {
            $this->subPagarMe = new Subscription();
            $this->subId = $this->params[0];

            $transactions = $this->subPagarMe->getTransactions($this->subId);

            $listTransactions = new ListTransactions($this, $transactions);
            $listTransactions->bindToController();
        }

        $this->addJs(url('themes/dealix/assets/js/jquery.mask.js'));
        BackendMenu::setContext('Dealix.Planos', 'planos', 'assinaturas');
    }

    public function formExtendFields($form, $fields)
    {
        $subscription = $this->subPagarMe->getSubscription($form->data->id);
        
        $fields['customer_name']->value = $subscription->customer->name;
        $fields['customer_email']->value = $subscription->customer->email;
        $fields['customer_phone']->value = "({$subscription->phone->ddd}) {$subscription->phone->number}";
        $fields['current_period_start']->value = $subscription->current_period_start;
        $fields['current_period_end']->value = $subscription->current_period_end;
        $fields['plan_days']->value = $subscription->plan->days;

        if ($subscription->payment_method == 'credit_card') {
            $fields['card_brand']->value = $subscription->card_brand;
            $fields['card_last_digits']->value = $subscription->card_last_digits;
        }
    }

    public function onCancelSubscription()
    {
        $this->subPagarMe->cancelSubscription($this->subId);
        
        \Flash::success('Assinatura cancelada com sucesso.');
        return \Redirect::refresh();
    }

    public function onSaveSubscription()
    {
        $data = post('Assinatura');
        $data['id'] = $this->subId;

        $result = $this->subPagarMe->updateSubscription($data);

        if ($result) 
            \Flash::success('Assinatura alterada com sucesso.');
        else
            \Flash::error('Ocorreu um erro e alguns dados não puderam ser alterados.');

        return \Redirect::refresh();
    }
}

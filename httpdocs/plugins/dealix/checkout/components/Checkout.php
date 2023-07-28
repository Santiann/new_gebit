<?php namespace Dealix\Checkout\Components;

use Cms\Classes\ComponentBase;
use Dealix\Pagarme\Classes\Subscription as PagarMeSubscription;
use Dealix\Register\Models\User;
use Dealix\Register\Models\User_Auth;
use Dealix\Planos\Models\Assinatura;
use Flash;
use Request;
use Validator;
use ValidationException;
use Exception;

class Checkout extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Checkout Component',
            'description' => 'Checkout component'
        ];
    }

    public function defineProperties()
    {
        return [];
    }
    
    public function onSubmit()
    {
        try {
            $data = post();

            if ($data['payment_method'] == 'credit_card') {
                $rules = [
                    'card_number' => 'required|min:13|max:16',
                    'card_holder_name' => 'required',
                    'card_expiration_month' => 'required|min:2|max:2',
                    'card_expiration_year' => 'required|min:2|max:2',
                    'card_cvv' => 'required|min:3|max:4',
                ];
                $validator = Validator::make($data, $rules);

                if ($validator->fails()) {
                    throw new ValidationException($validator);
                }
            }

            $user = new User();
            $user = $user->getAuthUser();

            $pagarmeSubscriptions = new PagarMeSubscription();
            $subscription = $pagarmeSubscriptions->create($data, $user);

            $subscription->api_token  = User_Auth::findByEmail($user->a001_email)->first()->api_token;

            if ($subscription) {
                $this->registerSubscription($subscription);
            }

            return [
                '#checkout-section' => $this->renderPartial('@fields/success', 
                    ['subscription' => $subscription, 'user' => \Auth::user()])
            ];
        } catch (Exception $ex) {
            if (Request::ajax()) throw $ex;
            else Flash::error($ex->getMessage());
        }
    }

    public function registerSubscription($subscription)
    {
        $data['id'] = $subscription->id;
        $data['customer_id'] = $subscription->customer->id ?? $subscription->customer_id;
        $data['plan_id'] = $subscription->plan->id ?? $subscription->plan_id;
        $data['status'] = $subscription->status;
        $data['payment_method'] = $subscription->payment_method;
        $data['current_period_start'] = $subscription->current_period_start ?? null;
        $data['current_period_end'] = $subscription->current_period_end ?? null;
        $data['date_created'] = $subscription->date_created ?? null;
        $data['date_updated'] = $subscription->date_updated ?? $subscription->date_created ?? null;

        Assinatura::create($data);
    }
}

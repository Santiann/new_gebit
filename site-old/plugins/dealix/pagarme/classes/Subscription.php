<?php namespace Dealix\Pagarme\Classes;

use Dealix\Checkout\Classes\Util;
use Dealix\Pagarme\Models\Settings;
use Dealix\Planos\Models\Assinatura;
use Dealix\Planos\Models\Plano;
use RainLab\User\Models\User;
use Dealix\Register\Models\User_Auth as UserSystem;

class Subscription
{
    private $pagarme;

    public function __construct()
    {
        $this->pagarme = new \PagarMe\Client(Settings::get('api_key'));
    }

    public function create($data, $user)
    {
        $formatted_data = $this->prepareToSubscribe($data, $user);
        $subscription = $this->subscribe($formatted_data);

        $plan = Plano::where('pagarme_id', $data['plan_id'])->first();
        $userSystem = UserSystem::where('email', \Auth::user()->email)->first();
        $userSystem->creditos = $plan->credits;
        $userSystem->save();

        $user = User::find(\Auth::user()->id);
        $user->pagarme_customer_id = $subscription->customer->id;
        $user->save();

        return $subscription;
    }

    private function prepareToSubscribe($data, $user)
    {
        $phone = Util::splitDddPhone($user->a001_telefone);

        $customer = [
            'email' => $user->a001_email,
            'name' => $user->a001_nome,
            'document_number' => $user->a001_cpf,
            'address' => [
                'street' => $user->a001_endereco,
                'street_number' => $user->a001_numero_end,
                'complementary' => $user->a001_complemento,
                'neighborhood' => $user->a001_bairro,
                'zipcode' => $user->a001_cep
            ],
            'phone' => [
                'ddd' => $phone['ddd'],
                'number' => $phone['number']
            ],
        ];

        unset($data['_token'], $data['_session_key']);
        
        if ($data['payment_method'] == 'credit_card') {
            $data['card_expiration_date'] = $data['card_expiration_month'] . $data['card_expiration_year'];
            $data['customer'] = $customer;
            $data['postback_url'] = Settings::get('postback_url');
            unset($data['card_expiration_month'], $data['card_expiration_year']);

            return $data;
        }
        else {
            $data_boleto['plan_id'] = $data['plan_id'];
            $data_boleto['payment_method'] = $data['payment_method'];
            $data_boleto['customer'] = $customer;
            $data_boleto['postback_url'] = Settings::get('postback_url');

            return $data_boleto;
        }
    }

    private function subscribe($data)
    {
        return $this->pagarme->subscriptions()->create($data);
    }

    public function getSubscription($id)
    {
        return $this->pagarme->subscriptions()->get([
            'id' => $id
        ]);
    }

    public function getTransactions($id)
    {
        return $this->pagarme->subscriptions()->transactions([
            'subscription_id' => $id
        ]);
    }

    public function updateSubscription($data)
    {
        return $this->updatePlan($data) && 
            $this->updatePaymentMethod($data);
    }

    private function updatePlan($data)
    {
        return $this->pagarme->subscriptions()->update([
            'id' => $data['id'],
            'plan_id' => $data['plano'],
        ]);
    }

    private function updatePaymentMethod($data)
    {
        $assinatura = Assinatura::find($data['id']);

        $new_data = [
            "id" => $data['id'],
            "payment_method" => $data['payment_method']
        ];

        if ($data['payment_method'] == 'credit_card') {
            $last_digits = substr($data['card_number'], -4);

            if ($last_digits != $assinatura->card_last_digits) {
                $credit_card = [
                    "card_number" =>  $data['card_number'],
                    "card_holder_name" => $data['card_holder_name'],
                    "card_expiration_date" => str_replace('/', '', $data['card_expiration_date']),
                    "card_cvv" => $data['card_cvv']
                ];
                $new_data = array_merge($new_data, $credit_card);

                return $this->pagarme->subscriptions()->update($new_data);
            }
        }
        else if ($assinatura->payment_method != $data['payment_method']) {
            return $this->pagarme->subscriptions()->update($new_data);
        }

        return true;
    }

    private function settleCharges($data)
    {
        return $this->pagarme->subscriptions()->settleCharges([
            'id' => $data['id'],
            'charges' => $data['settle_charges']
        ]);
    }

    public function cancelSubscription($id)
    {
        return $this->pagarme->subscriptions()->cancel([
            'id' => $id
        ]);
    }

    public function updateStatus()
    {
        try {
            $postback = post();
            $post_sub = $postback['subscription'];

            $subscription = Assinatura::find($postback['id']);
            $subscription->update([
                'status' => $postback['current_status'],
                'payment_method' => $post_sub['current_transaction']['payment_method'],
                'date_updated' => $post_sub['date_updated'],
                'current_period_start' => $post_sub['current_period_start'],
                'current_period_end' => $post_sub['current_period_end'],
                'card_last_digits' => $post_sub['current_transaction']['card_last_digits'],
            ]);

            $plan = Plano::where('pagarme_id', $subscription->plan_id)->first();
            $userSystem = UserSystem::where('email', $post_sub['customer']['email'])->first();
            $userSystem->creditos = $plan->credits;
            $userSystem->save();

            return response()->json(['success' => 'OK'], 200);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

<?php namespace App\Http\Classes\Pagarme;

use App\Assinatura;

class Subscription
{
    private $pagarme;

    public function __construct()
    {
        $this->pagarme = new \PagarMe\Client(env('PAGARME_API_KEY'));
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

    public function cancelSubscription($id)
    {
        return $this->pagarme->subscriptions()->cancel([
            'id' => $id
        ]);
    }
}

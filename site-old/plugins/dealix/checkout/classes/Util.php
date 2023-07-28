<?php namespace Dealix\Checkout\Classes;

use Dealix\Planos\Models\Plano;

class Util
{
    public static function isValidTransaction($transaction_id, $pagarme)
    {
        $transaction = $pagarme->transactions()->get([
            'id' => $transaction_id
        ]);

        $items_id = [];
        foreach ($transaction->items as $item) {
            array_push($items_id, $item->id);
        }

        $total = Plano::whereIn('id', $items_id)->get()->sum('valor');
        $total = number_format($total, 2, '', '');

        if ($transaction->authorized_amount == $total)
            return true;

        return false;
    }

    public static function splitDddPhone(string $phone): array
    {
        $phone = preg_replace('/[^A-Za-z0-9\-]/', '', $phone);
        $phone = ltrim($phone, 0);

        $ddd = substr($phone, 0, 2);
        $number = substr($phone, 2);

        return [
            'ddd'    => $ddd,
            'number' => preg_replace("/[^0-9]/", "", $number),
        ];
    }
}

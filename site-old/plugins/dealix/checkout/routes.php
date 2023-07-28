<?php

use Dealix\Checkout\Classes\Util;
use Dealix\Pagarme\Models\Settings;

Route::post('checkout/transactions/capture', function () {
    $pagarme = new PagarMe\Client(Settings::get('api_key'));
    $transaction_id = post('transaction_id');

    if (!Util::isValidTransaction($transaction_id, $pagarme))
        return false;

    $capturedTransaction = $pagarme->transactions()->capture([
        'id' => post('transaction_id'),
        'amount' => post('amount')
    ]);
    
    return $capturedTransaction;
});
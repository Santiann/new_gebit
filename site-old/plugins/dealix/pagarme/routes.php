<?php

use Dealix\Pagarme\Models\Settings;
use Dealix\Planos\Models\Assinatura;

// postbacks url
Route::post('subscription/update_status', 'Dealix\Pagarme\Classes\Subscription@updateStatus');

Route::get('api/subscriptions', function () {
    $pagarme = new PagarMe\Client(Settings::get('api_key'));
    $plans = $pagarme->subscriptions()->getList();
    dd($plans);
});

Route::get('api/postbacks/{id}', function ($id) {
    $pagarme = new PagarMe\Client(Settings::get('api_key'));
    $postbacks = $pagarme->postbacks()->getList([
        'model' => 'subscription', //pode ser transaction ou subscription
        'model_id' => $id
    ]);
    dd($postbacks);
});

Route::get('api/assinaturas', function () {
    dd(Assinatura::all());
});
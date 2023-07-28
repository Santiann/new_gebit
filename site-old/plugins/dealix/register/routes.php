<?php

use Prhost\CepGratis\CepGratis;
use Dealix\Register\Classes\Invite;
use Dealix\Register\Classes\Register;

Route::post('findAddressByCep', function () {
    $data = CepGratis::search(post('cep'));
    return json_encode($data); 
});

Route::get('company-invite/{name}/{email}/{user_host}', function ($name, $email, $user_host) {
    return Invite::registerAndInvite($name, $email, $user_host);
});

Route::post('verifyPhone', 'Dealix\Register\Classes\Register@startVerification');
Route::post('verifyCodePhone', 'Dealix\Register\Classes\Register@verifyCode');
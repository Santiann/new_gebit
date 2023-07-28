<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('dev','DevController@index');
Route::get('data/devtables', 'DevController@tableData')->name('devtables.data');
Route::get('dev/{tabela}/','DevController@crud');


Route::get('registrar','RegistrarController@create')->name('registrar');
Route::post('registrar/create','RegistrarController@store');
Route::get('registrar_buscaExistente','RegistrarController@buscaExistente')->name('registrar_buscaExistente');

Route::get('/validaUnicoExistente','Controller@validaUnicoExistente');
Route::get('/carregaCidade','CidadeController@carregaCidade');
Route::get('/carregaCidadeEstado','CidadeController@carregaCidadeEstado');


Route::get('/', function () {
    return Redirect::to('/dashboard');
});

Route::get('/login', function () {
    Auth::logout();
    //Session::flush();
    return Redirecto::to(env('URL_SITE').'/login');
});

Route::get('/login/{email}/{api_token}', function($email, $api_token) {
    $user = \App\User::where('email', $email)->first();
    
    if ($user && $user->api_token == $api_token) {
        Auth::login($user, true);
        return Redirect::to('/dashboard');
    }
    
    return abort(403, 'Usuário não autenticado.');
});

Route::get('/logout', function () {
    Auth::logout();
    //Session::flush();
    
    $client = new GuzzleHttp\Client(['base_uri' => env('URL_SITE')]);
    $client->request('GET', '/logout');
    
    return Redirect::to(env('URL_SITE').'/logout');
});

Auth::routes();



Route::group(['middleware' => ['auth','authsistema','validaacesso']], function() {

    Route::get('/paginanaoencontrada', function () {
        return view('home');
    });


    Route::get('/meusdados','Controller@meusdados')->name('meusdados');
    Route::get('/assinatura/{status?}','AssinaturaController@assinatura')->name('assinatura');
    Route::put('/assinatura/{id}','AssinaturaController@update')->name('assinatura.update');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');


    //Route::get('/notificacao', 'NotificacaoController@notificacao');
    Route::get('/notificacaoLida', 'HomeController@notificacaoLida')->name('notificacaoLida');

    Route::get('data/notificacao','NotificacaoController@datatable')->name('notificacao.data');
    Route::get('notificacao','NotificacaoController@index');


    foreach (File::allFiles(__DIR__ . '/web_routes') as $route_file) {
        require $route_file->getPathname();
    }

});

Route::get('users', 'UsersController@index');

Route::get('users-list', 'UsersController@usersList');

Route::get('imaptest', function(){
    /** @var \Webklex\PHPIMAP\Client $client */
$client = Webklex\IMAP\Facades\Client::account('default');

//Connect to the IMAP Server
$client->connect();


    $folder = $client->getFolder('INBOX');

    $message = $folder->messages()->since('14.11.2021')->get();

    event(new \Webklex\IMAP\Events\MessageNewEvent([$message->last()]));

});

Route::get('visualiza/{a997_id_email}/{a028_id_contrato_financeiro}/{a997_email_visualizado}', function($a997_id_email,$a028_id_contrato_financeiro,$a997_email_visualizado){
    $email = \App\Email::find($a997_id_email);
    $email->a997_IP_visualizado = \Request::ip();
    $email->a028_id_contrato_financeiro = $a028_id_contrato_financeiro;
    $email->a997_email_visualizado = $a997_email_visualizado;
    $email->save();
})->name('email.visualizar');
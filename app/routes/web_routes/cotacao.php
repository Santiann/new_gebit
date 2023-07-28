<?php
	// Rotas do item cotacao
	Route::get('data/cotacao',['as'=>'cotacao.data','uses'=>'CotacaoController@datatable','middleware' => ['permission:cotacao-show|cotacao-create|cotacao-edit|cotacao-delete']]);
	Route::get('cotacao',['as'=>'cotacao.index','uses'=>'CotacaoController@index','middleware' => ['permission:cotacao-show|cotacao-create|cotacao-edit|cotacao-delete']]);
	Route::get('cotacao/create',['as'=>'cotacao.create','uses'=>'CotacaoController@create','middleware' => ['permission:cotacao-create']]);
	Route::post('cotacao/create',['as'=>'cotacao.store','uses'=>'CotacaoController@store','middleware' => ['permission:cotacao-create']]);
	Route::get('cotacao/{id}',['as'=>'cotacao.show','uses'=>'CotacaoController@show']);
	Route::get('cotacao/{id}/edit',['as'=>'cotacao.edit','uses'=>'CotacaoController@edit','middleware' => ['permission:cotacao-edit']]);
	Route::patch('cotacao/{id}',['as'=>'cotacao.update','uses'=>'CotacaoController@update','middleware' => ['permission:cotacao-edit']]);
	Route::delete('cotacao/{id}',['as'=>'cotacao.destroy','uses'=>'CotacaoController@destroy','middleware' => ['permission:cotacao-delete']]);
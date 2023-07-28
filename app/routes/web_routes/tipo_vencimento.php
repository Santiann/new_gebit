<?php
	// Rotas do item tipo_vencimento
	Route::get('data/tipo_vencimento',['as'=>'tipo_vencimento.data','uses'=>'Tipo_vencimentoController@datatable','middleware' => ['permission:tipo_vencimento-show|tipo_vencimento-create|tipo_vencimento-edit|tipo_vencimento-delete']]);
	Route::get('tipo_vencimento',['as'=>'tipo_vencimento.index','uses'=>'Tipo_vencimentoController@index','middleware' => ['permission:tipo_vencimento-show|tipo_vencimento-create|tipo_vencimento-edit|tipo_vencimento-delete']]);
	Route::get('tipo_vencimento/create',['as'=>'tipo_vencimento.create','uses'=>'Tipo_vencimentoController@create','middleware' => ['permission:tipo_vencimento-create']]);
	Route::post('tipo_vencimento/create',['as'=>'tipo_vencimento.store','uses'=>'Tipo_vencimentoController@store','middleware' => ['permission:tipo_vencimento-create']]);
	Route::get('tipo_vencimento/{id}',['as'=>'tipo_vencimento.show','uses'=>'Tipo_vencimentoController@show']);
	Route::get('tipo_vencimento/{id}/edit',['as'=>'tipo_vencimento.edit','uses'=>'Tipo_vencimentoController@edit','middleware' => ['permission:tipo_vencimento-edit']]);
	Route::patch('tipo_vencimento/{id}',['as'=>'tipo_vencimento.update','uses'=>'Tipo_vencimentoController@update','middleware' => ['permission:tipo_vencimento-edit']]);
	Route::delete('tipo_vencimento/{id}',['as'=>'tipo_vencimento.destroy','uses'=>'Tipo_vencimentoController@destroy','middleware' => ['permission:tipo_vencimento-delete']]);
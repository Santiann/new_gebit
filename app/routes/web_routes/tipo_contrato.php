<?php
	// Rotas do item tipo_contrato
	Route::get('data/tipo_contrato',['as'=>'tipo_contrato.data','uses'=>'Tipo_contratoController@datatable','middleware' => ['permission:tipo_contrato-show|tipo_contrato-create|tipo_contrato-edit|tipo_contrato-delete']]);
	Route::get('tipo_contrato',['as'=>'tipo_contrato.index','uses'=>'Tipo_contratoController@index','middleware' => ['permission:tipo_contrato-show|tipo_contrato-create|tipo_contrato-edit|tipo_contrato-delete']]);
	Route::get('tipo_contrato/create',['as'=>'tipo_contrato.create','uses'=>'Tipo_contratoController@create','middleware' => ['permission:tipo_contrato-create']]);
	Route::post('tipo_contrato/create',['as'=>'tipo_contrato.store','uses'=>'Tipo_contratoController@store','middleware' => ['permission:tipo_contrato-create']]);
	Route::get('tipo_contrato/{id}',['as'=>'tipo_contrato.show','uses'=>'Tipo_contratoController@show']);
	Route::get('tipo_contrato/{id}/edit',['as'=>'tipo_contrato.edit','uses'=>'Tipo_contratoController@edit','middleware' => ['permission:tipo_contrato-edit']]);
	Route::patch('tipo_contrato/{id}',['as'=>'tipo_contrato.update','uses'=>'Tipo_contratoController@update','middleware' => ['permission:tipo_contrato-edit']]);
	Route::delete('tipo_contrato/{id}',['as'=>'tipo_contrato.destroy','uses'=>'Tipo_contratoController@destroy','middleware' => ['permission:tipo_contrato-delete']]);
<?php
	// Rotas do item pendencias_contrato
	Route::get('data/pendencias_contrato',['as'=>'pendencias_contrato.data','uses'=>'Pendencias_contratoController@datatable','middleware' => []]);
	Route::get('pendencias_contrato',['as'=>'pendencias_contrato.index','uses'=>'Pendencias_contratoController@index','middleware' => []]);
	Route::get('pendencias_contrato/create',['as'=>'pendencias_contrato.create','uses'=>'Pendencias_contratoController@create','middleware' => ['permission:pendencias_contrato-create']]);
	Route::post('pendencias_contrato/create',['as'=>'pendencias_contrato.store','uses'=>'Pendencias_contratoController@store','middleware' => ['permission:pendencias_contrato-create']]);
	Route::get('pendencias_contrato/{id}',['as'=>'pendencias_contrato.show','uses'=>'Pendencias_contratoController@show']);
	Route::get('pendencias_contrato/{id}/edit',['as'=>'pendencias_contrato.edit','uses'=>'Pendencias_contratoController@edit','middleware' => ['permission:pendencias_contrato-edit']]);
	Route::patch('pendencias_contrato/{id}',['as'=>'pendencias_contrato.update','uses'=>'Pendencias_contratoController@update','middleware' => ['permission:pendencias_contrato-edit']]);
	Route::delete('pendencias_contrato/{id}',['as'=>'pendencias_contrato.destroy','uses'=>'Pendencias_contratoController@destroy','middleware' => ['permission:pendencias_contrato-delete']]);
<?php
	// Rotas do item categoria_contrato
	Route::get('data/categoria_contrato',['as'=>'categoria_contrato.data','uses'=>'Categoria_contratoController@datatable','middleware' => ['permission:categoria_contrato-show|categoria_contrato-create|categoria_contrato-edit|categoria_contrato-delete']]);
	Route::get('categoria_contrato',['as'=>'categoria_contrato.index','uses'=>'Categoria_contratoController@index','middleware' => ['permission:categoria_contrato-show|categoria_contrato-create|categoria_contrato-edit|categoria_contrato-delete']]);
	Route::get('categoria_contrato/create',['as'=>'categoria_contrato.create','uses'=>'Categoria_contratoController@create','middleware' => ['permission:categoria_contrato-create']]);
	Route::post('categoria_contrato/create',['as'=>'categoria_contrato.store','uses'=>'Categoria_contratoController@store','middleware' => ['permission:categoria_contrato-create']]);
	Route::get('categoria_contrato/{id}',['as'=>'categoria_contrato.show','uses'=>'Categoria_contratoController@show']);
	Route::get('categoria_contrato/{id}/edit',['as'=>'categoria_contrato.edit','uses'=>'Categoria_contratoController@edit','middleware' => ['permission:categoria_contrato-edit']]);
	Route::patch('categoria_contrato/{id}',['as'=>'categoria_contrato.update','uses'=>'Categoria_contratoController@update','middleware' => ['permission:categoria_contrato-edit']]);
	Route::delete('categoria_contrato/{id}',['as'=>'categoria_contrato.destroy','uses'=>'Categoria_contratoController@destroy','middleware' => ['permission:categoria_contrato-delete']]);
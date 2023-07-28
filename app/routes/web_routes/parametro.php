<?php
	// Rotas do item parametro
	Route::get('data/parametro',['as'=>'parametro.data','uses'=>'ParametroController@datatable','middleware' => ['permission:parametro-show|parametro-create|parametro-edit|parametro-delete']]);
	Route::get('parametro',['as'=>'parametro.index','uses'=>'ParametroController@index','middleware' => ['permission:parametro-show|parametro-create|parametro-edit|parametro-delete']]);
	Route::get('parametro/create',['as'=>'parametro.create','uses'=>'ParametroController@create','middleware' => ['permission:parametro-create']]);
	Route::post('parametro/create',['as'=>'parametro.store','uses'=>'ParametroController@store','middleware' => ['permission:parametro-create']]);
	Route::get('parametro/{id}',['as'=>'parametro.show','uses'=>'ParametroController@show']);
	Route::get('parametro/{id}/edit',['as'=>'parametro.edit','uses'=>'ParametroController@edit','middleware' => ['permission:parametro-edit']]);
	Route::patch('parametro/{id}',['as'=>'parametro.update','uses'=>'ParametroController@update','middleware' => ['permission:parametro-edit']]);
	Route::delete('parametro/{id}',['as'=>'parametro.destroy','uses'=>'ParametroController@destroy','middleware' => ['permission:parametro-delete']]);
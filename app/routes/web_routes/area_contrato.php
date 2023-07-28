<?php
	// Rotas do item area_contrato
	Route::get('data/area_contrato',['as'=>'area_contrato.data','uses'=>'Area_contratoController@datatable','middleware' => ['permission:area_contrato-show|area_contrato-create|area_contrato-edit|area_contrato-delete']]);
	Route::get('area_contrato',['as'=>'area_contrato.index','uses'=>'Area_contratoController@index','middleware' => ['permission:area_contrato-show|area_contrato-create|area_contrato-edit|area_contrato-delete']]);
	Route::get('area_contrato/create',['as'=>'area_contrato.create','uses'=>'Area_contratoController@create','middleware' => ['permission:area_contrato-create']]);
	Route::post('area_contrato/create',['as'=>'area_contrato.store','uses'=>'Area_contratoController@store','middleware' => ['permission:area_contrato-create']]);
	Route::get('area_contrato/{id}',['as'=>'area_contrato.show','uses'=>'Area_contratoController@show']);
	Route::get('area_contrato/{id}/edit',['as'=>'area_contrato.edit','uses'=>'Area_contratoController@edit','middleware' => ['permission:area_contrato-edit']]);
	Route::patch('area_contrato/{id}',['as'=>'area_contrato.update','uses'=>'Area_contratoController@update','middleware' => ['permission:area_contrato-edit']]);
	Route::delete('area_contrato/{id}',['as'=>'area_contrato.destroy','uses'=>'Area_contratoController@destroy','middleware' => ['permission:area_contrato-delete']]);
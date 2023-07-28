<?php
	// Rotas do item usuario
	Route::get('data/usuario',['as'=>'usuario.data','uses'=>'UsuarioController@datatable','middleware' => ['permission:usuario-show|usuario-create|usuario-edit|usuario-delete']]);
	Route::get('usuario',['as'=>'usuario.index','uses'=>'UsuarioController@index','middleware' => ['permission:usuario-show|usuario-create|usuario-edit|usuario-delete']]);
	Route::get('usuario/create',['as'=>'usuario.create','uses'=>'UsuarioController@create','middleware' => ['permission:usuario-create']]);
	Route::post('usuario/create',['as'=>'usuario.store','uses'=>'UsuarioController@store','middleware' => ['permission:usuario-create']]);
	Route::get('usuario/{id}',['as'=>'usuario.show','uses'=>'UsuarioController@show']);
	Route::get('usuario/{id}/edit',['as'=>'usuario.edit','uses'=>'UsuarioController@edit','middleware' => ['permission:usuario-edit']]);
	Route::patch('usuario/{id}',['as'=>'usuario.update','uses'=>'UsuarioController@update','middleware' => ['permission:usuario-edit']]);
	Route::delete('usuario/{id}',['as'=>'usuario.destroy','uses'=>'UsuarioController@destroy','middleware' => ['permission:usuario-delete']]);


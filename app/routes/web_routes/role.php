<?php
/*
Route::get('data/role',['as'=>'role.data','uses'=>'RoleController@datatable']);
Route::get('role',['as'=>'role.index','uses'=>'RoleController@index']);
Route::get('role/create',['as'=>'role.create','uses'=>'RoleController@create']);
Route::post('role/create',['as'=>'role.store','uses'=>'RoleController@store']);
Route::get('role/{id}',['as'=>'role.show','uses'=>'RoleController@show']);
Route::get('role/{id}/edit',['as'=>'role.edit','uses'=>'RoleController@edit']);
Route::patch('role/{id}',['as'=>'role.update','uses'=>'RoleController@update']);
Route::delete('role/{id}',['as'=>'role.destroy','uses'=>'RoleController@destroy']);
*/
//*


Route::get('/usuarioEmpresa','RoleController@usuarioEmpresa');

	// Rotas do item role
	Route::get('data/role',['as'=>'role.data','uses'=>'RoleController@datatable','middleware' => ['permission:roles-show|roles-create|roles-edit|roles-delete']]);
	Route::get('role',['as'=>'role.index','uses'=>'RoleController@index','middleware' => ['permission:roles-show|roles-create|roles-edit|roles-delete']]);
	Route::get('role/create',['as'=>'role.create','uses'=>'RoleController@create','middleware' => ['permission:roles-create']]);
	Route::post('role/create',['as'=>'role.store','uses'=>'RoleController@store','middleware' => ['permission:roles-create']]);
	Route::get('role/{id}',['as'=>'role.show','uses'=>'RoleController@show']);
	Route::get('role/{id}/edit',['as'=>'role.edit','uses'=>'RoleController@edit','middleware' => ['permission:roles-edit']]);
	Route::patch('role/{id}',['as'=>'role.update','uses'=>'RoleController@update','middleware' => ['permission:roles-edit']]);
	Route::delete('role/{id}',['as'=>'role.destroy','uses'=>'RoleController@destroy','middleware' => ['permission:roles-delete']]);
//*/

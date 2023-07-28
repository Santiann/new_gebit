<?php
//Permissions

Route::get('data/permissions',['as'=>'permissions.data','uses'=>'PermissionsController@datatable','middleware' => ['permission:permissions-show|permissions-create|permissions-edit|permissions-delete']]);
Route::get('permissions',['as'=>'permissions.index','uses'=>'PermissionsController@index','middleware' => ['permission:permissions-show|permissions-create|permissions-edit|permissions-delete']]);
Route::get('permissions/create',['as'=>'permissions.create','uses'=>'PermissionsController@create','middleware' => ['permission:permissions-create']]);
Route::post('permissions/create',['as'=>'permissions.store','uses'=>'PermissionsController@store','middleware' => ['permission:permissions-create']]);
Route::get('permissions/{id}',['as'=>'permissions.show','uses'=>'PermissionsController@show']);
Route::get('permissions/{id}/edit',['as'=>'permissions.edit','uses'=>'PermissionsController@edit','middleware' => ['permission:permissions-edit']]);
Route::patch('permissions/{id}',['as'=>'permissions.update','uses'=>'PermissionsController@update','middleware' => ['permission:permissions-edit']]);
Route::delete('permissions/{id}',['as'=>'permissions.destroy','uses'=>'PermissionsController@destroy','middleware' => ['permission:permissions-delete']]);

Route::get('permissions_retornaMenu',['as'=>'permissions.retornaMenu','uses'=>'PermissionsController@retornaMenu']);

<?php




// Rotas do item empresa
Route::get('data/empresa',['as'=>'empresa.data','uses'=>'EmpresaController@datatable','middleware' => ['permission:empresa-show|empresa-create|empresa-edit|empresa-delete']]);

Route::get('empresa',['as'=>'empresa.index','uses'=>'EmpresaController@index','middleware' => ['permission:empresa-show|empresa-create|empresa-edit|empresa-delete']]);
Route::get('empresa/create',['as'=>'empresa.create','uses'=>'EmpresaController@create','middleware' => ['permission:empresa-create']]);
Route::post('empresa/create',['as'=>'empresa.store','uses'=>'EmpresaController@store','middleware' => ['permission:empresa-create']]);
Route::get('empresa/{id}',['as'=>'empresa.show','uses'=>'EmpresaController@show']);
Route::get('empresa/{id}/edit',['as'=>'empresa.edit','uses'=>'EmpresaController@edit','middleware' => ['permission:empresa-edit']]);
Route::patch('empresa/{id}',['as'=>'empresa.update','uses'=>'EmpresaController@update','middleware' => ['permission:empresa-edit']]);
Route::delete('empresa/{id}',['as'=>'empresa.destroy','uses'=>'EmpresaController@destroy','middleware' => ['permission:empresa-delete']]);

Route::get('empresa_buscaExistente/{todos?}/{cli_for?}',['as'=>'empresa.buscaExistente','uses'=>'EmpresaController@buscaExistente']);
Route::get('empresa/{id}/show',['as'=>'empresa.show','uses'=>'EmpresaController@show','middleware' => ['permission:empresa-edit']]);


Route::get('emp_empresa',['as'=>'emp_empresa.index','uses'=>'EmpresaController@index','middleware' => ['permission:emp_empresa-show|emp_empresa-create|emp_empresa-edit|emp_empresa-delete']])->defaults('tipo', 'empresa');
Route::get('emp_cliente',['as'=>'emp_cliente.index','uses'=>'EmpresaController@index','middleware' => ['permission:emp_cliente-show|emp_cliente-create|emp_cliente-edit|emp_cliente-delete']])->defaults('tipo', 'cliente');
Route::get('emp_fornecedor',['as'=>'emp_fornecedor.index','uses'=>'EmpresaController@index','middleware' => ['permission:emp_fornecedor-show|emp_fornecedor-create|emp_fornecedor-edit|emp_fornecedor-delete']])->defaults('tipo', 'fornecedor');

Route::get('emp_empresa/create',['as'=>'emp_empresa.create','uses'=>'EmpresaController@create','middleware' => ['permission:emp_empresa-create']])->defaults('tipo', 'empresa');
Route::get('emp_cliente/create',['as'=>'emp_cliente.create','uses'=>'EmpresaController@create','middleware' => ['permission:emp_cliente-create']])->defaults('tipo', 'cliente');
Route::get('emp_fornecedor/create',['as'=>'emp_fornecedor.create','uses'=>'EmpresaController@create','middleware' => ['permission:emp_fornecedor-create']])->defaults('tipo', 'fornecedor');

Route::get('emp_empresa/{id}/edit/{tipo?}/{notificarContatos?}',['as'=>'emp_empresa.edit','uses'=>'EmpresaController@edit','middleware' => ['permission:emp_empresa-edit']]);
Route::get('emp_cliente/{id}/edit',['as'=>'emp_cliente.edit','uses'=>'EmpresaController@edit','middleware' => ['permission:emp_cliente-edit']])->defaults('tipo', 'cliente');
Route::get('emp_fornecedor/{id}/edit',['as'=>'emp_fornecedor.edit','uses'=>'EmpresaController@edit','middleware' => ['permission:emp_fornecedor-edit']])->defaults('tipo', 'fornecedor');

Route::delete('emp_empresa/{id}',['as'=>'emp_empresa.destroy','uses'=>'EmpresaController@destroy','middleware' => ['permission:emp_empresa-delete']])->defaults('tipo', 'empresa');
Route::delete('emp_cliente/{id}',['as'=>'emp_cliente.destroy','uses'=>'EmpresaController@destroy','middleware' => ['permission:emp_cliente-delete']])->defaults('tipo', 'cliente');
Route::delete('emp_fornecedor/{id}',['as'=>'emp_fornecedor.destroy','uses'=>'EmpresaController@destroy','middleware' => ['permission:emp_fornecedor-delete']])->defaults('tipo', 'fornecedor');

Route::get('emp_empresa/{id}',['as'=>'emp_empresa.show','uses'=>'EmpresaController@show'])->defaults('tipo', 'empresa');
Route::get('emp_cliente/{id}',['as'=>'emp_cliente.show','uses'=>'EmpresaController@show'])->defaults('tipo', 'cliente');
Route::get('emp_fornecedor/{id}',['as'=>'emp_fornecedor.show','uses'=>'EmpresaController@show'])->defaults('tipo', 'fornecedor');

Route::get('emp_empresa/{id}/show',['as'=>'emp_empresa.edit','uses'=>'EmpresaController@show','middleware' => ['permission:emp_empresa-edit']])->defaults('tipo', 'empresa');
Route::get('emp_cliente/{id}/show',['as'=>'emp_cliente.edit','uses'=>'EmpresaController@show','middleware' => ['permission:emp_cliente-edit']])->defaults('tipo', 'cliente');
Route::get('emp_fornecedor/{id}/show',['as'=>'emp_fornecedor.edit','uses'=>'EmpresaController@show','middleware' => ['permission:emp_fornecedor-edit']])->defaults('tipo', 'fornecedor');

Route::post('notificarAlteracaoContato/{id}',['as'=>'alteracao_contato.notificar','uses'=>'EmpresaController@notificarAlteracaoContato','middleware' => ['permission:emp_empresa-edit|emp_cliente-edit|emp_fornecedor-edit']]);
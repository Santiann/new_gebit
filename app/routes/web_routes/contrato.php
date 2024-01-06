<?php
	// Rotas do item contrato
	Route::get('data/contrato',['as'=>'contrato.data','uses'=>'ContratoController@datatable','middleware' => ['permission:contrato-show|contrato-create|contrato-edit|contrato-delete']]);
	Route::get('contrato',['as'=>'contrato.index','uses'=>'ContratoController@index','middleware' => ['permission:contrato-show|contrato-create|contrato-edit|contrato-delete']]);
	Route::get('contrato/create',['as'=>'contrato.create','uses'=>'ContratoController@create','middleware' => ['permission:contrato-create']]);
	// Route::post('contrato/create',['as'=>'contrato.store','uses'=>'ContratoController@store','middleware' => ['permission:contrato-create']]);
	Route::get('contrato/createcontrato',['as'=>'contrato.store','uses'=>'ContratoController@store','middleware' => ['permission:contrato-create']]);
	Route::get('contrato/{id}',['as'=>'contrato.show','uses'=>'ContratoController@show']);
	Route::get('contrato/{id}/edit',['as'=>'contrato.edit','uses'=>'ContratoController@edit','middleware' => ['permission:contrato-edit']]);
	Route::get('contrato/{id}/showFornecedor',['as'=>'contrato.showFornecedor','uses'=>'ContratoController@showFornecedor','middleware' => ['permission:contrato-edit']]);
	Route::patch('contrato/{id}',['as'=>'contrato.update','uses'=>'ContratoController@update','middleware' => ['permission:contrato-edit']]);
	Route::delete('contrato/{id}',['as'=>'contrato.destroy','uses'=>'ContratoController@destroy','middleware' => ['permission:contrato-delete']]);

    Route::get('/carregaOptionsEmpresa','ContratoController@carregaOptionsEmpresa');
    Route::get('/carregaCategoriaDocumentos','ContratoController@carregaCategoriaDocumentos');
	Route::post('/salvarUsuarios/{id}','ContratoController@salvarUsuarios');
	Route::post('/salvarAnotacao/{id}','ContratoController@salvarAnotacao');
	Route::post('/salvarComentarioAnotacao/{id}','ContratoController@salvarComentarioAnotacao');
	Route::post('/salvarPendencia/{id}','ContratoController@salvarPendencia');
	Route::post('/salvarStatusPendencia/{id}','ContratoController@salvarStatusPendencia');
	Route::post('/salvarStatusFinanceiro/{id}','ContratoController@salvarStatusFinanceiro');
	Route::post('/salvarNovaParcelaFinanceiro/{id}','ContratoController@salvarNovaParcelaFinanceiro');

    Route::get('contrato/copy/{id}',['as'=>'contrato.copy','uses'=>'ContratoController@copy','middleware' => ['permission:contrato-edit']]);

    Route::get('relatoriocontrato',['as'=>'contrato.relatorio','uses'=>'ContratoController@relatorio','middleware' => ['permission:contrato-show']]);


Route::get('data/contrato_relatorio',['as'=>'contrato_relatorio.data','uses'=>'ContratoController@relatoriodatatable','middleware' => ['permission:contrato-show|contrato-create|contrato-edit|contrato-delete']]);

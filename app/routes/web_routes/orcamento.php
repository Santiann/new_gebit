<?php
	// Rotas do item orcamento
	Route::get('data/orcamento',['as'=>'orcamento.data','uses'=>'OrcamentoController@datatable','middleware' => ['permission:orcamento-show|orcamento-create|orcamento-edit|orcamento-delete']]);
	Route::get('orcamento',['as'=>'orcamento.index','uses'=>'OrcamentoController@index','middleware' => ['permission:orcamento-show|orcamento-create|orcamento-edit|orcamento-delete']]);
	Route::get('orcamento/{id}/edit',['as'=>'orcamento.edit','uses'=>'OrcamentoController@edit','middleware' => ['permission:orcamento-edit']]);
	Route::get('orcamento/{id}/{idEmpresa}',['as'=>'orcamento.orcar','uses'=>'OrcamentoController@orcar','middleware' => ['permission:orcamento-edit']]);
	Route::patch('orcamento/{id}',['as'=>'orcamento.update','uses'=>'OrcamentoController@update','middleware' => ['permission:orcamento-edit']]);
	Route::delete('orcamento/{id}',['as'=>'orcamento.destroy','uses'=>'OrcamentoController@destroy','middleware' => ['permission:orcamento-delete']]);

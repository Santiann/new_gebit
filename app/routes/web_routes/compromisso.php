<?php
	// Rotas do item compromisso
	Route::get('data/compromisso',['as'=>'compromisso.data','uses'=>'CompromissoController@datatable','middleware' => ['permission:compromisso-show|compromisso-create|compromisso-edit|compromisso-delete']]);
	Route::get('compromisso',['as'=>'compromisso.index','uses'=>'CompromissoController@index','middleware' => ['permission:compromisso-show|compromisso-create|compromisso-edit|compromisso-delete']]);
	Route::get('compromisso/create',['as'=>'compromisso.create','uses'=>'CompromissoController@create','middleware' => ['permission:compromisso-create']]);
	Route::post('compromisso/create',['as'=>'compromisso.store','uses'=>'CompromissoController@store','middleware' => ['permission:compromisso-create']]);
	Route::get('compromisso/{id}',['as'=>'compromisso.show','uses'=>'CompromissoController@show']);
	Route::get('compromisso/{id}/edit',['as'=>'compromisso.edit','uses'=>'CompromissoController@edit','middleware' => ['permission:compromisso-edit']]);
	Route::patch('compromisso/{id}',['as'=>'compromisso.update','uses'=>'CompromissoController@update','middleware' => ['permission:compromisso-edit']]);
	Route::delete('compromisso/{id}',['as'=>'compromisso.destroy','uses'=>'CompromissoController@destroy','middleware' => ['permission:compromisso-delete']]);

	Route::get('data/compromisso_financeiro',['as'=>'compromisso_financeiro.data','uses'=>'CompromissoFinanceiroController@datatable','middleware' => ['permission:compromisso-show|compromisso-create|compromisso-edit|compromisso-delete']]);
	Route::get('compromisso_financeiro',['as'=>'compromisso_financeiro.index','uses'=>'CompromissoFinanceiroController@index','middleware' => ['permission:compromisso-show|compromisso-create|compromisso-edit|compromisso-delete']]);
	Route::get('compromisso_financeiro',['as'=>'compromisso_financeiro.index','uses'=>'CompromissoFinanceiroController@index','middleware' => ['permission:compromisso-show|compromisso-create|compromisso-edit|compromisso-delete']]);
	Route::get('compromisso_financeiro/create',['as'=>'compromisso_financeiro.create','uses'=>'CompromissoFinanceiroController@create','middleware' => ['permission:compromisso-create']]);
	Route::post('compromisso_financeiro/create',['as'=>'compromisso_financeiro.store','uses'=>'CompromissoFinanceiroController@store','middleware' => ['permission:compromisso-create']]);
	Route::get('compromisso_financeiro/{id}',['as'=>'compromisso_financeiro.show','uses'=>'CompromissoFinanceiroController@show']);
	Route::get('compromisso_financeiro/{id}/edit',['as'=>'compromisso_financeiro.edit','uses'=>'CompromissoFinanceiroController@edit','middleware' => ['permission:compromisso-edit']]);
	Route::patch('compromisso_financeiro/{id}',['as'=>'compromisso_financeiro.update','uses'=>'CompromissoFinanceiroController@update','middleware' => ['permission:compromisso-edit']]);
	Route::delete('compromisso_financeiro/{id}',['as'=>'compromisso_financeiro.destroy','uses'=>'CompromissoFinanceiroController@destroy','middleware' => ['permission:compromisso-delete']]);



Route::get('relatoriocompromisso',['as'=>'compromisso.relatorio','uses'=>'CompromissoController@relatorio','middleware' => ['permission:compromisso-show']]);


Route::get('data/compromisso_relatorio',['as'=>'compromisso_relatorio.data','uses'=>'CompromissoController@relatoriodatatable','middleware' => ['permission:compromisso-show|compromisso-create|compromisso-edit|compromisso-delete']]);


 Route::get('/carregaOptionsEmpresaCompromisso','CompromissoController@carregaOptionsEmpresaCompromisso');

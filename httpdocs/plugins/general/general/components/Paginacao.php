<?php namespace General\General\Components;

use General\General\Classes\FilterComponent;
use October\Rain\Database\Builder;

class Paginacao extends FilterComponent
{
	private $paginator;
	
	protected  $field = 'pagina';
	
    public function componentDetails()
    {
        return [
            'name'        => 'Paginação',
            'description' => 'Adiciona paginação na página'
        ];
    }

    /**
     * Define os parametros configuráveis dos componenentes
     */
    public function defineProperties()
    {
    	$baseAttr = parent::defineProperties();
    	
    	$newAttr = [
			'perPage' => [
                'title'       => 'Itens por Página',
                'description' => 'Quantidade de itens exibidos até uma paginação.',
                'type'        => 'string',
                'default'     => 10,
            ]
    	];
    	
    	return array_merge($baseAttr,$newAttr);
	}
	
	public function defineFilterProperties()
    {    	
    	return [
			'perPage' => [
                'title'       => 'Itens por Página',
                'description' => 'Quantidade de itens exibidos até uma paginação.',
                'type'        => 'string',
                'default'     => 10,
            ],
            'first'=>[
                'title' => 'primeira execução'    
            ]
    	];
  	}
    
    
	public function afterApplyQuery(Builder $queryBuilder)
	{
		$perPage = $this->property('perPage',10);
		$currentPage = $this->loadCurrentPage();

		$this->paginator = $queryBuilder->paginate($perPage, $currentPage);
	}
	
	public function getField()
	{
		return $this->field;
	}
	
	public function getPaginator()
	{
		return $this->paginator;
	}
	
	private function loadCurrentPage()
	{
		return input('pagina',1);
	}
	
	protected function prepareVars()
	{
	    $currentPage = $this->data;
	    
	    if ($this->property('component') == 'noticias_listagem' && $currentPage == 1){
		    $this->perPage = 10;
	    } else {
	        $this->perPage = $this->property('perPage',10);
	    }
	}	
}
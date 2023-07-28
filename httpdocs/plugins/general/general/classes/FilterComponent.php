<?php namespace General\General\Classes;

use Cms\Classes\ComponentBase;
use October\Rain\Database\Builder;
use Illuminate\Http\Request;

/**
 * Definição de uma estrutura para componentes que aplicar filtros sobre um
 * componente pai. Deve estar presente na mesma página 
 * 
 * @author Hélio <helio@general.com.br>
 * @package General\Noticias
 */
abstract class FilterComponent extends ComposableComponent
{
	public $data;

	public $fieldName;
	
	protected $FIELD_ARRAY_NAME = 'filtro';
		
	private $active = true;
		
	private $filterFunctions = [];
	
	/**
	 * Função para definição de propriedades que substitui a define properties
	 * para os plugins que serão usados como filtros
	 */
	public abstract function defineFilterProperties();
	
	/**
	 * Função para definição das propriedades dos filtros
	 * {@inheritDoc}
	 * @see \General\General\Classes\ComposableComponent::defineProperties()
	 */
	public function defineProperties(){
		
		$composableProps = parent::defineProperties();
		
		$filtrableProps = [
			'dataFrom' => [
				'title' => 'Fonte de dados',
				'description' => 'Determina como será a captura das informações para os filtros',
				'type'		  	=> 'set',
				'items'			=> [
					0		=> "post",
					1		=> 'segmento de url',
					2		=> "get",
				],
				'default' => [0,2]
			],
			'dataName' => [
				'title' => 'Nome da Fonte',
				'description' => 'Determina o nome do atributo de onde vem as informações, se vazio, o padrão é o alias do compoente',
				'type'	=> 'string'				
			]
		];
		
		$filterProps = $this->defineFilterProperties();
		return array_merge($composableProps,$filtrableProps, $filterProps);
	}
	
	public function onRun()
	{
		$this->fieldName = $this->getFieldName();
		return parent::onRun();
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \Cms\Classes\ComponentBase::onRender()
	 */
	public function onRender()
	{
		parent::onRender();
		$this->prepareVars();
		$this->loadData();
	}	
	
	/**
	 * Adicionar uma função anonima para tratar a query no momento da consulta
	 * @param \Closure $filter
	 */
	public function addQuery(\Closure $filter)
	{
		array_push($this->filterFunctions,$filter);
	}
	
	/**
	 * Método executado antes das querys na fila
	 * @param Builder $queryBuilder
	 * @return \October\Rain\Database\Builder
	 */
	public function beforeApplyQuery(Builder $queryBuilder)
	{
		return $queryBuilder;
	}
	
	/**
	 * Método executado depois das querys na fila
	 * @param Builder $queryBuilder
	 * @return unknown
	 */
	public function afterApplyQuery(Builder $queryBuilder)
	{
		return $queryBuidler;
	}
	
	/**
	 * Aplica todas as querys na fila e seus antecessores e predecessores
	 * @param Builder $queryBuilder
	 * @return boolean
	 */
	public function applyQuery(Builder $queryBuilder)
	{
		if(!$this->active)
		{
			return false;
		}
	
		$this->prepareVars();
		
		$this->beforeApplyQuery($queryBuilder);
		
		foreach($this->filterFunctions as $function)
		{
			$function($queryBuilder);
		}
		
		$this->afterApplyQuery($queryBuilder);
	}

	/**
	 * Carrega as informações desse filtro vindas de post ou get,
	 * Prioridade para POST porque é vindo por AJAX na página
	 */
	public function loadData($default = null)
	{
		$inputFieldName 	= $this->getArrayName();
		$allowedMethods 	= $this->property('dataFrom',[0,1,2]);
		$data 				= $default;

		//Se post, captura por post
		if(request()->isMethod('post') && in_array('0',$allowedMethods))
		{
			$data = post($inputFieldName,$data);
		}
		
		if(in_array('1',$allowedMethods))
		{
			$data = $this->property('dataName', $this->alias);
		}
		
		if(in_array('2',$allowedMethods))
		{
			$data = get($inputFieldName,$data);
		}
				
		return $this->data = $data;
	}
	
	public function getFieldName()
	{
		$name = $this->property('dataName', $this->alias);
		return $this->FIELD_ARRAY_NAME.'['.$name.']';
	}
	
	public function getArrayName()
	{
		$name = $this->property('dataName', $this->alias);
		return $this->FIELD_ARRAY_NAME.'.'.$name;
	}
	/**
	 * Função para carregar as propriedades e outras variáveis dentro da classe
	 */
	protected abstract function prepareVars();
}
<?php namespace General\General\Classes;

use Cms\Classes\ComponentBase;
use October\Rain\Database\Builder;
use October\Rain\Database\Collection;
use October\Rain\Database\Model;

/**
 * Classe para definição de um componente que pode ser filtrado através de outros
 * componentes, filhos e presentes na mesma página.
 * 
 * @author Hélio <helio@general.com.br>
 * @package General\General
 */
abstract class FiltrableComponent extends ComposableComponent
{
	//// Attributes
	
	public $list;
	
	protected $model;
		
	protected $filterParameter = 'filter';
	 
	protected $filters = ['id'];
	 
	protected $filterMethods = ['POST','GET'];
	
	private $modelObject = null;
		
	//// Methods
	
	public function onRender()
	{
		$this->loadComponents();
		$this->prepareVars();
		$this->loadQuery();
		$this->loadFilterData();
	}
			
	public function getQueryString()
	{
		return 'TBD';
	}
	
	protected abstract function prepareQuery(Builder $builder);
	
	protected abstract function setList(Collection $collection);
	
	protected abstract function prepareVars();
	
	protected function getList()
	{
		return $this->list;
	}
	
	protected function loadComponents()
	{
		$this->page->page->afterFetch();
		$this->page->page->runComponents();
	}
	
	private function loadQuery()
	{
		$this->loadFilterData();
		
		$query 		= $this->loadQueryBuilder();
		$builder 	= $this->prepareQuery($query);
		$this->applyFilterFunctions($builder);
		$this->list = $this->setList($builder->get());
	}
	
	private function loadQueryBuilder()
	{
		if(empty($this->model))
		{
			throw new \Exception('O componente deve ter definido um attributo chamado "model"',500);
		}
		
		return $this->modelObject = (new $this->model)->select('*');
	
	}
	
	private function applyFilterFunctions(Builder $builder)
	{			
		$this->foreachChild(function($component) use ($builder) 
		{
			$component->applyQuery($builder);
		});
	}
	
	private function loadFilterData()
	{
		$this->foreachChild(function($component)
		{
			$component->loadData();
		});
	}
	
	/**
	 * @return Model
	 */
	public function getModel()
	{
		return $this->model;
	}
}
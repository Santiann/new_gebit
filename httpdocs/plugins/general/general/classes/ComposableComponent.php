<?php namespace General\General\Classes;

use Cms\Classes\ComponentBase;

/**
 * Define uma classe para componentes que podem ser agrupados como uma
 * árvore de dependências. Tanto filhos como pais, devem herdar dessa classe.
 * 
 * @author Hélio <helio@general.com.br>
 * @package General\General
 */
abstract class ComposableComponent extends ComponentBase
{
	private $component = null;
	
	private $childComponents = [];
	
	/**
	 * Define atributos básico de configuração do componente
	 * @return string[][]
	 */
	public function defineProperties()
	{
		return [
			'component' => [
				'title'       => 'Componente Pai',
				'description' => 'Nome ou alias, de qual componente pertence esse modificador',
				'type'        => 'string'
			],
		];
	}
	
	/**
	 * Define o que será executado no inicio do componente
	 * {@inheritDoc}
	 * @see \Cms\Classes\ComponentBase::onInit()
	 */
	public function onRun()
	{
		parent::onRun();
		$this->loadParentComponent();
	}
	
	/**
	 * Adicina outros componentes como filhos deste
	 * @param ComponentBase $component
	 */
	public function addChildComponent(ComponentBase $component)
	{
		array_push($this->childComponents, $component);
	}
	
	public function getParent()
	{
		return $this->component;
	}
	
	/**
	 * Carrega o componente pai desse componente
	 */
	protected function loadParentComponent()
	{
		$parentIdentifier = $this->property('component',false);
		if(!empty($parentIdentifier))
		{
			$this->component = $this->page->components[$this->property('component')];
			$this->component->addChildComponent($this);
		}
	}
	
	protected function foreachChild(\Closure $function)
	{
		foreach($this->childComponents as $component)
		{
			$function($component);
		}
	}
}
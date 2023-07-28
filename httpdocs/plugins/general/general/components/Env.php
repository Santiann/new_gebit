<?php namespace General\General\Components;

use October\Rain\Database\Builder;
use Cms\Classes\ComponentBase;

class Env extends ComponentBase
{
	public $show;
	public $label;
	
    public function componentDetails()
    {
        return [
            'name'        => 'Ambiente de Aplicação',
            'description' => 'Adiciona na página um aviso do ambiente atual'
        ];
    }

    /**
     * Define os parametros configuráveis dos componenentes
     */
    public function defineProperties()
    {
    	return [
            'envCode'    => [
                'title'         => 'Codigos dos Envs',
                'description'   => 'Quais ambientes devem exibir a mensagem de aviso',
                'type'          => 'dictionary',
            	'default'		=> [
            		'dev' => 'Desenvolvimento',
            		'test' => 'Teste',
            		'testing' => 'Teste'
            	]
            ],
    		'active'	=> [
    			'tite' 			=> 'Ativo',
    			'description' 	=> 'Força a exibição ou ocultaçao da mensagem',
    			'type'			=> 'checkbox',
    			'default'		=> 1
    		]
    			
    	];
    }
 
    public function onRender()
    {
    	
    	if(!$this->property('active'))
    	{
    		$this->show = false;
    		return false;
    	}
    	
    	$env = app()->environment();
    	$envsToLookFor = $this->property('envCode');
        	
    	if(isset($envsToLookFor[$env]))
    	{
    		
    		$this->show = true;
    		$this->label = $envsToLookFor[$env];
    	}
    	
    }
}   
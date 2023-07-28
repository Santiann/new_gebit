<?php namespace Dealix\Faq\Components;

use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Dealix\Faq\Models\Group;

class Groups extends ComponentBase
{

    public $onlyWithItens;

    public $categoryProperty;

    public $categoryPage;

    public $sort;

    public $limit;

    public $itens;



    public function componentDetails()
    {
        return [
            'name'        => 'Grupos',
            'description' => 'Grupos cadastrados no F.A.Q'
        ];
    }

    public function defineProperties()
    {
        return [
            'onlyWithItens' => [
                'title'       => 'Ocultar grupos vazios',
                'description' => 'Não exibe os grupos que não tiverem perguntas',
                'type'        => 'checkbox',
                'default'     => ''
            ],
            'categoryPage'  => [
                'title'         => 'Páginas de Grupos',
                'description'   => 'Página para a exibição dos grupos',
                'type'          => 'dropdown',
                'group'         => 'Category'
            ],
            'categoryProperty'  => [
                'title'         => 'Propriedade na Url',
                'description'   => 'Propriedade na url para receber o slug da categoria',
                'type'          => 'text',
                'default'       => 'category',
                'group'         => 'Category'
            ]
        ];
    }


    public function getCategoryPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    private function prepareVars(){

        $this->onlyWithItens        = $this->property('onlyWithItens');
        $this->categoryPage         = $this->property('categoryPage');
        $this->categoryProperty     = $this->property('categoryProperty');
    }

    public function onRun()
    {
        $this->prepareVars();
        $this->itens                = $this->loadGroups();

    }

    private function loadGroups(){

        $groups  =  Group::all();

        $groups->each(function($item){
            $item->setUrl($this->categoryPage, $this->categoryProperty, $this->controller);
        });

        return $groups;
    }
}

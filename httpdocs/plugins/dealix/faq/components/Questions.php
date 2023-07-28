<?php namespace Dealix\Faq\Components;

use Dealix\Faq\Models\Question;
use Cms\Classes\ComponentBase;
use Cms\Classes\Page;


class Questions extends ComponentBase
{

    public $sort;

    public $onlyWithItens;

    public $categoryFilter;

    public $search;

    public $questionPage;

    public $questionProperty;

    public $itens;


    public function componentDetails()
    {
        return [
            'name'        => 'Questões',
            'description' => 'Questões cadastradas no F.A.Q'
        ];
    }

    public function defineProperties()
    {
        return [
            'sort' => [
                'title'       => 'Ordenação',
                'description' => 'Ordenação do Grupo',
                'type'        => 'dropdown',
                'default'     => 'id asc'
            ],
            'limit'         => [
                'title'         => 'Limite de Exibição',
                'description'   => 'Quantidade limite de itens na exibição',
                'type'          => 'string',
                'default'       => '20'
            ],
            'searchParameter' => [
                'title'       => 'Parametro de Busca',
                'description' => 'Nome do attributo GET para utilizar no filtro',
                'type'        => 'string',
                'default'     => '',
                'group'         => 'Filters'
            ],
            'categoryFilter' => [
                'title'       => 'Category',
                'description' => 'Categoria para filtrar as duvidas do F.A.Q.',
                'type'        => 'string',
                'default'     => '{{ :category }}',
                'group'         => 'Filters'
            ],
            'questionPage'  => [
                'title'         => 'Páginas de Grupos',
                'description'   => 'Página para a exibição dos grupos',
                'type'          => 'dropdown',
                'group'         => 'Question'
            ],
            'questionProperty'  => [
                'title'         => 'Propriedade na Url',
                'description'   => 'Propriedade na url para receber o slug da categoria',
                'type'          => 'text',
                'default'       => 'question',
                'group'         => 'Question'
            ]
        ];
    }

    public function getQuestionPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function getSortOptions(){

        return Question::$sortOptions;

    }

    private function prepareVars(){

        $this->sort             = explode(' ',$this->property('sort'));
        $this->limit            = $this->property('limit');
        $this->onlyWithItens    = $this->property('onlyWithItens');
        $this->categoryFilter   = $this->property('categoryFilter');
        $this->questionPage     = $this->property('questionPage');
        $this->questionProperty = $this->property('questionProperty');
        $this->search           = get($this->property('searchParameter'),false);

    }

    public function onRun()
    {
        $this->prepareVars();
        $this->itens           = $this->loadQuestions();
    }

    private function loadQuestions(){

        $questions =  Question::isPublished()->applyFilters($this->sort,$this->limit);

        if($this->search !== false){
            $questions->filterSearch($this->search);
        }

        if($this->categoryFilter != 'todas-categorias' and $this->categoryFilter != null){
            $questions->filterCategory($this->categoryFilter);
        }

        $result = $questions->get();

        $result->each(function($item){
            $item->setUrl($this->questionPage, $this->questionProperty, $this->controller);
        });

        return $result;
    }

}

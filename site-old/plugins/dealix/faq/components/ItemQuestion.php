<?php namespace Dealix\Faq\Components;

use Dealix\Faq\Models\Question;
use Cms\Classes\ComponentBase;

class ItemQuestion extends ComponentBase
{
    public $questionSlug;

    public $item;

    public $related;

    public function componentDetails()
    {
        return [
            'name'        => 'Iterna Questão',
            'description' => 'Questões cadastradas no F.A.Q'
        ];
    }

    public function defineProperties()
    {
        return [
            'questionSlug' => [
                'title'       => 'QuestionSlug',
                'description' => 'Questão para exibir a interna',
                'type'        => 'string',
                'default'     => '{{ :question }}'
            ]
        ];
    }

    private function prepareVars(){

        $this->questionSlug    = $this->property('questionSlug');

    }

    public function onRun()
    {
        $this->prepareVars();
        $this->item           = $this->loadItem();
        $this->related        = $this->loadRelated();
    }

    private function loadItem(){

        $builder = Question::isPublished();
        $resultItem = $builder->where('seo_slug','=',$this->questionSlug)->first();

        //Incrementa o contador de acessos
        if($resultItem){
            $resultItem->update(['acessed' => $resultItem->acessed + 1]);
        }

        return $resultItem;
    }

    private function loadRelated(){

        $related =  $this->item->childs()->isPublished()->get();
        $related->each(function($item){
            $item->setUrl($this->questionPage, $this->questionProperty, $this->controller);
        });

        return $related;
    }
}

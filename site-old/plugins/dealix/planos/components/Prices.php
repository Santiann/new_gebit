<?php namespace Dealix\Planos\Components;

use Dealix\Planos\Models\Plano;
use Cms\Classes\ComponentBase;

class Prices extends ComponentBase
{
    public $plans;

    public function componentDetails()
    {
        return [
            'name'        => 'Exibição de planos',
            'description' => 'Exibe os planos no front do site'
        ];
    }

    public function defineProperties()
    {
        return [
            'pageNumber' => [
                'title'       => 'rainlab.blog::lang.settings.posts_pagination',
                'description' => 'rainlab.blog::lang.settings.posts_pagination_description',
                'type'        => 'string',
                'default'     => '{{ :page }}'
            ]
        ];
    }

   public function onRun()
   {
       $this->plans = Plano::isPublished()->get();
   }
}
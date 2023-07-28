<?php namespace General\Paginas\Models;

use General\Paginas\Classes\Page;
use \October\Rain\Database\Model;
use System\Models\PluginVersion;

/**
 * Class Pagina
 * @package General\Paginas\Models
 */
class Pagina extends Model
{
    // use Validation;
    public $timestamps = false;

    //Configura qual tabela ser� mapeada na model
    public $table = 'general_paginas_pagina';

    //Configura quais campos poder�o ser seu conteudo preenchido direatamente pela model
    protected $fillable = [
        'identificador'
        ,'seo_title'
        ,'seo_description'
    ];

    // Configura��o de relacionamento
    public $hasMany = [
        'conteudo' => [
            'General\Paginas\Models\Conteudo',
            'key' => 'identificador',
            'otherKey' => 'pagina'
        ]
    ];

    public $attributeNames  = [
        'seo_title'         => '"Título da Página"',
        'seo_description'   => '"Descrição da Página"'
    ];

    public $implement = ['@General.Translate.Behaviors.TranslatableModel'];

    public $translatable = ['seo_title','seo_description'];

    /**
     * Method for finding a page by its identifier
     * @param $identifier string
     * @return mixed
     */
    public static function findPage($identifier)
    {
        return self::where('identificador', $identifier)->first();
    }

    /**
     * @param $pageObject Page
     */
    public static function updatePage($pageObject)
    {
        $url = $pageObject->getSettings('url');
        $metaTitle = $pageObject->getSettings('meta_title');
        $metaDescription = $pageObject->getSettings('meta_description');

        self::updatePageSettings($url, $metaTitle, $metaDescription);
    }

    public static function updatePageSettings($pageUrl, $metaTitle, $metaDescription)
    {
        $pagina = self::firstOrNew(['identificador' => $pageUrl]);
        $pagina->seo_description    = $metaDescription;
        $pagina->seo_title          = $metaTitle;
        $pagina->save();
    }

}
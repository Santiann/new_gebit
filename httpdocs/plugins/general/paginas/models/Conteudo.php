<?php namespace General\Paginas\Models;

use General\Paginas\Classes\Page;
use October\Rain\Database\Model;
use System\Models\PluginVersion;

/**
 * Model para controle do conteudo salvo em banco
 * Class Conteudo
 * @package General\Paginas\Models
 */
class Conteudo extends Model
{

    public $table = 'general_paginas_conteudo';

    public $fillable = ['identificador', 'valor'];

    public $timestamps = false;

    public $jsonable = ['valor'];

    public $translatable = ['valor'];

    public $belongsTo = [
        'paginaModel' => ['\General\Paginas\Models\Pagina',
            'key'      => 'pagina',
            'otherKey' => 'identificador'
        ]
    ];

    public $implement = ['@General.Paginas.Behaviors.PageTranslatableModel'];

    public static function findPageContent($page)
    {
        $result = self::where('pagina', $page)
            ->where('identificador', '!=', '')
            ->get();

        return $result->lists('valor', 'identificador');

    }

    public static function updateField($identifier, $value, $page, $title)
    {
        $conteudo = self::firstOrNew(['identificador' => $identifier, 'pagina' => $page]);

        if ($value) {
            $conteudo->valor = $value;
        } else {
            $conteudo->valor = '';
        }
        $conteudo->pagina = $page;
        $conteudo->titulo = $title;
        $conteudo->identificador = $identifier;

        $conteudo->save();

        return $conteudo->id;
    }

    /**
     * @param $content array
     * @param $page Page
     */
    public static function updatePage($content = [], $page)
    {
        $ids = [];

        if (!count($content) > 0) {
            return false;
        }

        foreach ($content as $identifier => $valor) {
            $ids[] = self::updateField($identifier, $valor, $page->getSettings('url'), $page->getSettings('title'));
        }
    }
}
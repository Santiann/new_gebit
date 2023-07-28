<?php namespace General\General;

use Carbon\Carbon;
use Event;
use Backend;
use System\Classes\PluginBase;
use CMS\Classes\Theme;
use October\Rain\Support\Facades\Config;
use Cms\Classes\Controller;
use Cms\Classes\Partial;

/**
 * Classe para registro do Plugin General
 * @author Hélio Figueira <helio@general.com.br>
 */
class Plugin extends PluginBase
{

    /**
     * Retorna informaçao geral do plugin
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'General',
            'description' => 'Sistema para gerenciamento de campos editáveis',
            'author'      => 'Agência 110',
            'icon'        => 'icon-cogs'
        ];
    }

    /**
     * Configurações no boot do plugin
     * {@inheritDoc}
     * @see \System\Classes\PluginBase::boot()
     */
    public function boot()
    {
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        Carbon::setLocale('pt_BR');

        if (!\App::runningInBackend()) {
            return;
        }

        Event::listen('backend.page.beforeDisplay', function ($controller, $action, $params) {
            $controller->addJs('/plugins/general/general/assets/js/jquery.maskedinput.min.js');
            $controller->addJs('/plugins/general/general/assets/js/custom.maskedinput.js');

            $controller->addJs('/plugins/general/general/assets/js/jquery.maskemoney.min.js');
            $controller->addJs('/plugins/general/general/assets/js/custom.maskedmoney.js');
        });
    }

    /**
     * Registra markups para novas funçõe e filtros para o twig
     * {@inheritDoc}
     * @see \System\Classes\PluginBase::registerMarkupTags()
     */
    public function registerMarkupTags()
    {
        return [
            'filters'   => [
                'svg'    => [$this, 'openSVG'],
                'slugfy' => [$this, 'slugfy'],
            ],
            'functions' => [
                'dd'     => function ($var) {
                    dd($var);
                },
                'dump' => function ($var) {
                    dump($var);
                }
            ]
        ];
    }

    /**
     * Configura quais componentes o pluguin irá disponibilizar na página
     * @return array
     */
    public function registerComponents()
    {
        return [
//            'General\General\Components\AdminBar'          => 'general_general_adminbar',
//            'General\General\Components\Env'               => 'general_general_env',

            //Filtros
            // 'General\General\Components\FiltroPaginacao'  		=> 'general_general_filtroPaginacao',
//            'General\General\Components\Paginacao'         => 'general_general_paginacao',
//            'General\General\Components\FiltroTexto'       => 'general_general_filtroTexto',
//            'General\General\Components\FiltroRelacionado' => 'general_general_filtroRelacionado'
        ];
    }

    /**
     * Registra novos tipos de campo
     * {@inheritDoc}
     * @see \System\Classes\PluginBase::registerFormWidgets()
     */
    public function registerFormWidgets()
    {
        return [
            'General\General\FormWidgets\CascadeDropdown' => 'cascadedropdown',
        ];
    }

    // Filtros e Funções do Twig

    public function openSVG($file)
    {
        $theme = Theme::getActiveTheme();
        $url = 'themes' . DIRECTORY_SEPARATOR . $theme->getId();

        $path = $url . DIRECTORY_SEPARATOR . $file;

        echo file_get_contents($path);
    }

    public function slugfy($string = null)
    {
        $slug = preg_replace(['/([`^~\'"])/', '/([-]{2,}|[-+]+|[\s]+)/', '/(,-)/'], [null, '-', ', '], iconv('UTF-8', 'ASCII//TRANSLIT', $string));
        return strtolower($slug);
    }
}

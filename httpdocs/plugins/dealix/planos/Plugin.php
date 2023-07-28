<?php namespace Dealix\Planos;

use Backend;
use System\Classes\PluginBase;

/**
 * Classe de definição do plugin
 * Class Plugin
 * @package Dealix\Planos
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Planos',
            'description' => 'Sistema de planos da Dealix',
            'author'      => 'Dealix',
            'icon'        => 'icon-list'
        ];
    }

    /**
     * Retorna as ifnormações dos menus de navegação do plugin
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'planos' => [
                'label'       => 'Planos',
                'url'         => Backend::url('dealix/planos/planos'),
                'icon'        => 'icon-list',
                'permissions' => ['dealix.plano.*'],
                'order'       => 500,
                'sideMenu'    => [
                    'planos' => [
                        'label'       => 'Listar Planos',
                        'icon'        => 'icon-list',
                        'url'         => Backend::url('dealix/planos/planos'),
                        'permissions' => ['dealix.planos.plano'],
                    ],
                    'assinaturas' => [
                        'label'       => 'Assinaturas',
                        'icon'        => 'icon-list',
                        'url'         => Backend::url('dealix/planos/assinaturas'),
                        'permissions' => ['dealix.planos.assinatura'],
                    ]
                ]
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
            //'Dealix\Planos\Components\FormSignup'       => 'formsignup',
            'Dealix\Planos\Components\Prices'       => 'prices',
        ];
    }

    /**
     * Registra as persrmissões necessárias para acessar as funcões do painel
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'dealix.planos.plano'      => ['tab' => 'dealix.planos::lang.plugin.name', 'label' => 'dealix.planos::lang.settings.manage_plano'],
        ];
    }

}
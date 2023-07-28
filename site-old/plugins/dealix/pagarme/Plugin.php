<?php namespace Dealix\Pagarme;

use Backend;
use System\Classes\PluginBase;

/**
 * pagarme Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'pagarme',
            'description' => 'Configurações para o Pagar.me',
            'author'      => 'dealix',
            'icon'        => 'icon-money'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Dealix\Pagarme\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'dealix.pagarme.some_permission' => [
                'tab' => 'pagarme',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Pagar.me',
                'description' => 'Configurações do plugin Pagar.me',
                'category'    => 'Pagamentos',
                'icon'        => 'icon-money',
                'class'       => 'Dealix\Pagarme\Models\Settings',
                'order'       => 500,
            ]
        ];
    }
}

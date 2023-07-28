<?php namespace Dealix\Checkout;

use Backend;
use System\Classes\PluginBase;

/**
 * checkout Plugin Information File
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
            'name'        => 'checkout',
            'description' => 'No description provided yet...',
            'author'      => 'dealix',
            'icon'        => 'icon-leaf'
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
        return [
            'Dealix\Checkout\Components\SelectedPlan' => 'selectedPlan',
            'Dealix\Checkout\Components\Checkout' => 'checkout',
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
            'dealix.checkout.some_permission' => [
                'tab' => 'checkout',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'checkout' => [
                'label'       => 'checkout',
                'url'         => Backend::url('dealix/checkout/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['dealix.checkout.*'],
                'order'       => 500,
            ],
        ];
    }

    public function registerMarkupTags()
    {
        return [
            'functions' => [
                'env' => function($variable) { return env($variable); }
            ]
        ];
    }
}

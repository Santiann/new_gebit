<?php namespace General\BackendUser;

use General\BackendUser\Classes\Event\ExtendBackendUser;
use System\Classes\PluginBase;
use Backend;

/**
 * BackendUser Plugin Generaltion File
 */
class Plugin extends PluginBase
{
    /**
     * Returns generaltion about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'BackendUser',
            'description' => 'Plugin que sobrescreve o controle de usuarios e permissao do painel',
            'author'      => 'General',
            'icon'        => 'icon-leaf'
        ];
    }

    public function boot()
    {
        $this->addEventListener();
    }

    protected function addEventListener()
    {
        \Event::subscribe(ExtendBackendUser::class);
    }
}

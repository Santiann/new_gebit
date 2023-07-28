<?php namespace Dealix\Faq;

use Backend\Facades\Backend;
use System\Classes\PluginBase;

/**
 * Faq Plugin Information File
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
            'name'        => 'F.A.Q',
            'description' => 'Gerencia de pergutas e categorias',
            'author'      => 'Agência 110',
            'icon'        => 'icon-leaf'
        ];
    }

    public function registerComponents(){

        return [
            'Dealix\Faq\Components\Groups'       => 'dealix_faq_groups',
            'Dealix\Faq\Components\Questions'    => 'dealix_faq_questions',
            'Dealix\Faq\Components\ItemQuestion' => 'dealix_faq_item_question',
        ];
    }

    public function registerPermissions()
    {
        return [
            'dealix.faq.groups'       => ['tab' => 'F.A.Q', 'label' => 'Gerenciar Grupos do FAQ']
        ];
    }

    public function registerNavigation()
    {
        return [
            'faq' => [
                'label'       => 'FAQ',
                'url'         => Backend::url('dealix/faq/groups'),
                'icon'        => 'icon-bullhorn',
                'permissions' => ['dealix.faq.*'],
                'order'       => 500,

                'sideMenu' => [
                    'groups' => [
                        'label'       => 'Grupos',
                        'url'         => Backend::url('dealix/faq/groups'),
                        'icon'        => 'icon-pencil',
                        'permissions' => ['dealix.faq.groups'],
                    ]
                ]
            ]
        ];
    }

}

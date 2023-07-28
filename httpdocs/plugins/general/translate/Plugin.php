<?php namespace General\Translate;

use Lang;
use Event;
use Backend;
use Cms\Classes\Page;
use System\Classes\PluginBase;
use General\Translate\Models\Message;
use General\Translate\Classes\EventRegistry;
use Exception;

/**
 * Translate Plugin Information File
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
            'name'        => 'general.translate::lang.plugin.name',
            'description' => 'general.translate::lang.plugin.description',
            'author'      => 'Alexey Bobkov, Samuel Georges',
            'icon'        => 'icon-language',
            'homepage'    => 'https://github.com/general/translate-plugin'
        ];
    }

    public function register()
    {
        /*
         * Defer event 2 levels deep to let others contribute before this registers.
         */
        Event::listen('backend.form.extendFieldsBefore', function($widget) {
            EventRegistry::instance()->registerFormFieldReplacements($widget);
        }, -1);

        /*
         * Handle translated page URLs
         */
        Page::extend(function($page) {
            $page->extendClassWith('General\Translate\Behaviors\TranslatablePageUrl');
        });
    }

    public function boot()
    {
        /*
         * Set the page context for translation caching.
         */
        Event::listen('cms.page.beforeDisplay', function($controller, $url, $page) {
            EventRegistry::instance()->setMessageContext($page);
        });

        /*
         * Import messages defined by the theme
         */
        Event::listen('cms.theme.setActiveTheme', function($code) {
            EventRegistry::instance()->importMessagesFromTheme();
        });

        /*
         * Adds language suffixes to content files.
         */
        Event::listen('cms.page.beforeRenderContent', function($controller, $fileName) {
            return EventRegistry::instance()
                ->findTranslatedContentFile($controller, $fileName)
            ;
        });

        /*
         * Prune localized content files from template list
         */
        Event::listen('pages.content.templateList', function($widget, $templates) {
            return EventRegistry::instance()
                ->pruneTranslatedContentTemplates($templates);
        });
    }

    public function registerComponents()
    {
        return [
           'General\Translate\Components\LocalePicker' => 'localePicker'
        ];
    }

    public function registerPermissions()
    {
        return [
            'general.translate.manage_locales'  => [
                'tab'   => 'general.translate::lang.plugin.tab',
                'label' => 'general.translate::lang.plugin.manage_locales'
            ],
            'general.translate.manage_messages' => [
                'tab'   => 'general.translate::lang.plugin.tab',
                'label' => 'general.translate::lang.plugin.manage_messages'
            ]
        ];
    }

    public function registerSettings()
    {
        return [
            'locales' => [
                'label'       => 'general.translate::lang.locale.title',
                'description' => 'general.translate::lang.plugin.description',
                'icon'        => 'icon-language',
                'url'         => Backend::url('general/translate/locales'),
                'order'       => 550,
                'category'    => 'general.translate::lang.plugin.name',
                'permissions' => ['general.translate.manage_locales']
            ],
            'messages' => [
                'label'       => 'general.translate::lang.messages.title',
                'description' => 'general.translate::lang.messages.description',
                'icon'        => 'icon-list-alt',
                'url'         => Backend::url('general/translate/messages'),
                'order'       => 551,
                'category'    => 'general.translate::lang.plugin.name',
                'permissions' => ['general.translate.manage_messages']
            ]
        ];
    }

    /**
     * Register new Twig variables
     * @return array
     */
    public function registerMarkupTags()
    {
        return [
            'filters' => [
                '_'  => [$this, 'translateString'],
                '__' => [$this, 'translatePlural']
            ]
        ];
    }

    public function registerFormWidgets()
    {
        return [
            'General\Translate\FormWidgets\MLText' => [
                'label' => 'Text (ML)',
                'code'  => 'mltext'
            ],
            'General\Translate\FormWidgets\MLTextarea' => [
                'label' => 'Textarea (ML)',
                'code'  => 'mltextarea'
            ],
            'General\Translate\FormWidgets\MLRichEditor' => [
                'label' => 'Rich Editor (ML)',
                'code'  => 'mlricheditor'
            ],
            'General\Translate\FormWidgets\MLMarkdownEditor' => [
                'label' => 'Markdown Editor (ML)',
                'code'  => 'mlmarkdowneditor'
            ],
            'General\Translate\FormWidgets\MLRepeater' => [
                'label' => 'Repeater (ML)',
                'code'  => 'mlrepeater'
            ],
            'General\Translate\FormWidgets\MLMediaFinder' => [
                'label' => 'Media Finder (ML)',
                'code'  => 'mlmediafinder'
            ]
        ];
    }

    public function translateString($string, $params = [])
    {
        return Message::trans($string, $params);
    }

    public function translatePlural($string, $count = 0, $params = [])
    {
        return Lang::choice($string, $count, $params);
    }
}

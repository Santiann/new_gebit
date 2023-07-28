<?php

namespace General\Paginas {

    use General\Paginas\Classes\PageRender;
    use Event;
    use Backend;
    use General\Paginas\Classes\Controller;
    use General\Paginas\Classes\Page as StaticPage;
    use General\Paginas\Classes\Router;
    use General\Paginas\Classes\Snippet;
    use General\Paginas\Classes\SnippetManager;
    use Cms\Classes\Theme;
    use System\Classes\PluginBase;

    class Plugin extends PluginBase
    {
        public $require = ['General.Translate'];

        public function pluginDetails()
        {
            return [
                'name'        => 'Páginas',
                'description' => 'Plugin para controle de submódulos e conteúdos dinamico de sites',
                'author'      => 'Hélio Figueira Junior',
                'icon'        => 'icon-files-o',
                'homepage'    => 'https://bitbucket.com/general/october-paginas'
            ];
        }

        public function registerComponents()
        {
            return [
                '\General\Paginas\Components\PageContent' => 'general_paginas_pagecontent',
            ];
        }

        public function registerPermissions()
        {
            return [
                'general.paginas.manage_pages' => [
                    'tab'   => 'general.paginas::lang.page.tab',
                    'order' => 200,
                    'label' => 'general.paginas::lang.page.manage_pages'
                ]
            ];
        }

        public function registerNavigation()
        {
            return [
                'pages' => [
                    'label'       => 'general.paginas::lang.plugin.name',
                    'url'         => Backend::url('general/paginas/conteudo'),
                    'icon'        => 'icon-files-o',
                    'permissions' => ['general.paginas.*'],
                    'order'       => 20
                ]
            ];
        }

        public function boot()
        {
            $this->registerEvents();
        }

        public static function clearCache()
        {
            $theme = Theme::getEditTheme();

            $router = new Router($theme);
            $router->clearCache();

            SnippetManager::clearCache($theme);
        }

        private function registerEvents()
        {
            Event::listen('cms.page.beforeRenderPage', function ($controller, $page) {

                $renderer = new PageRender($controller, $page);
                $renderedContent = $renderer->render();

                return $renderedContent;

            });

            Event::listen('cms.template.save', function ($controller, $template, $type) {
                Plugin::clearCache();
            });

            Event::listen('cms.template.processSettingsBeforeSave', function ($controller, $dataHolder) {
                $dataHolder->settings = Snippet::processTemplateSettingsArray($dataHolder->settings);
            });

            Event::listen('cms.template.processSettingsAfterLoad', function ($controller, $template) {
                Snippet::processTemplateSettings($template);
            });

            Event::listen('cms.template.processTwigContent', function ($template, $dataHolder) {
                if ($template instanceof \Cms\Classes\Layout) {
                    $dataHolder->content = Controller::instance()->parseSyntaxFields($dataHolder->content);
                }
            });
        }

    }
}
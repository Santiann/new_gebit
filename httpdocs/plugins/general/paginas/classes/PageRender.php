<?php namespace General\Paginas\Classes;

use Cms\Twig\Extension as CmsTwigExtension;
use General\Paginas\Classes\Parser as SyntaxParser;
use General\Paginas\Models\Conteudo;
use General\Paginas\Models\Pagina;

class PageRender
{
    /**
     * @var \Cms\Classes\Controller
     */
    private $controller;

    /**
     * @var \Cms\Classes\Page
     */
    private $page;


    public function __construct($controller, $page)
    {
        $this->controller = $controller;
        $this->page = $page;
    }

    public function render()
    {
        try {

            $this->loadBindings();
            $twigParser = $this->loadTwigExtensions();
            $pageRawMarkup = $this->page->markup;
            $pageTwigMarkup = $this->dynamicSyntaxToTwig($pageRawMarkup);
            $pageVars = $this->loadPageVars($pageRawMarkup);

            $finalHtml = $this->twigToHtml($pageTwigMarkup, $twigParser, $pageVars);
            return $finalHtml;

        } catch (\Exception $e) {
            throw $e;
        }

    }

    private function loadBindings()
    {
        $this->controller->getLoader()->setObject($this->page);
    }

    protected function jsonDecodeRecursive($content, int $count = 1)
    {
        $count = $count + 1;
        $result = json_decode($content);
        if (json_last_error() === JSON_ERROR_NONE && (is_array($result) || is_object($result))) {
            return $result;
        } else if ($count > 10) {
            return $content;
        } else {
            return $this->jsonDecodeRecursive($result, $count);
        }
    }

    private function loadPageVars($pageRawMarkup)
    {
        $this->page->toArray();
        $url = $this->page->getOriginal('url') ?: $this->page->settings['url'];
        $page = Pagina::findPage($url);
        $storedContent = Conteudo::findPageContent($url);

        foreach ($storedContent as $key => $content) {
            if (is_string($content)) {
                $result = $this->jsonDecodeRecursive($content);
                if (is_array($result) || is_object($result)) {
                    $storedContent[$key] = $result;
                }
            }
        }

        $defaultTitle = array_get($this->page->settings, 'title', '');
        $defaultDescription = '';

        $defaultTitle = isset($this->page->meta_title) ? $this->page->meta_title : $defaultTitle;
        $defaultDescription = isset($this->page->meta_description) ? $this->page->meta_description : $defaultDescription;

        //Se a página já estiver salva, pegue conteudo do banco.
        if ($page != null and count($storedContent) > 0) {
            $varsToParse = $this->controller->vars + $storedContent;
            $varsToParse['this']['page']->seo_title = !empty($page->seo_title) ? $page->seo_title : $defaultTitle;
            $varsToParse['this']['page']->seo_description = !empty($page->seo_description) ? $page->seo_description : $defaultDescription;

        } //Caso contrário, pegue os default do formulário
        else {

            $storedContent = $this->loadPageDefaults($pageRawMarkup);
            $varsToParse = $this->controller->vars + $storedContent;

            $varsToParse['this']['page']->seo_title = $defaultTitle;
            $varsToParse['this']['page']->seo_description = $defaultDescription;
        }

        return $varsToParse;
    }

    private function loadTwigExtensions()
    {
        $twig = \App::make('twig.environment');

        if (!$twig->hasExtension('CMS')) {
            $twig->addExtension(new CmsTwigExtension($this->controller));
        }

        // if(!$twig->hasExtension('Text')){
        //     $twig->addExtension(new \Twig_Extensions_Extension_Text());
        // }

        return $twig;
    }

    private function dynamicSyntaxToTwig($pageRawMarkup)
    {
        $syntax = SyntaxParser::parse($pageRawMarkup);
        return $syntax->toTwig();
    }

    private function loadPageDefaults($pageRawMarkup)
    {
        $syntax = SyntaxParser::parse($pageRawMarkup);
        $formConfig = $syntax->toEditor();

        return $this->getLevelDefaults($formConfig);

    }

    private function twigToHtml($pageTwigMarkup, $twigParser, $variables)
    {
        $twigLoadedParser = $twigParser->createTemplate($pageTwigMarkup);
        return $twigLoadedParser->render($variables);
    }

    private function getLevelDefaults($formConfig)
    {
        $defaults = [];

        foreach ($formConfig as $fieldName => $fieldConfig) {
            if ($fieldConfig['type'] == 'repeater') {
                $defaults[$fieldName][0] = $this->getLevelDefaults($fieldConfig['fields']);
                continue;
            }
            $defaults[$fieldName] = $fieldConfig['default'];

        }

        return $defaults;
    }
}

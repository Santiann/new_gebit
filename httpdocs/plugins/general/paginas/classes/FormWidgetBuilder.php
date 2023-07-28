<?php namespace General\Paginas\Classes;

use General\Paginas\Models\Conteudo;
use General\Paginas\Models\Pagina;
use Backend\Classes\Controller;
use Cms\Classes\Page as CmsPage;
use October\Rain\Parse\Syntax\Parser as SyntaxParser;

class FormWidgetBuilder
{
    const fistLevelPage = 'pageContent';

    /** @var  Page Reference to original object */
    protected $pageObject;

    /** @var  Controller Reference to original object */
    protected $controller;

    protected $alias;

    protected $pageWrapper;

    protected $formTranslatableFields = [];

    public function __construct(Page &$pageObject, &$controller, $alias)
    {
        $this->pageObject = $pageObject->getCmsPage();
        $this->pageWrapper = $pageObject;
        $this->controller = $controller;
        $this->alias = $alias;
    }

    public function getWidget()
    {
        $fullConfig = $this->getWidgetConfig();
        $widget =  $this->controller->makeWidget('Backend\Widgets\Form', $fullConfig);

        $fields = $widget->secondaryTabs['fields'];
        $this->getTranslatableFields($fields);
        $widget->model->translatable = $this->formTranslatableFields;

        return $widget;
    }

    protected function createBaseConfig()
    {
        if(\Request::ajax()) {
            $widgetConfig = $this->controller->makeConfig('~/plugins/general/paginas/classes/page/fields.yaml');
        }else{
            $widgetConfig = new \stdClass();
        }

        $widgetConfig->model = $this->pageWrapper;
        $widgetConfig->alias = $this->alias ? $this->alias : 'form'.studly_case('page').md5($this->pageObject->getFileName()).uniqid();

        return $widgetConfig;
    }

    protected function getWidgetConfig()
    {
        $pageInnerFields = $this->extractInnerFieldsFromPage();
        $pageMetaFields = $this->extractOuterFieldsFromPage();
        $pageData = $this->loadPageData();

        $formFields['fields']  = $pageInnerFields+$pageMetaFields;
        $baseConfig = $this->createBaseConfig();
        $baseConfig->secondaryTabs = $formFields;
        $baseConfig->data =  $pageData;

        return $baseConfig;
    }

    protected function getTranslatableFields($fields)
    {
        foreach($fields as $fieldName => $fieldConfig)
        {
//            if(isset($fieldConfig['form']))
//            {
//                $this->getTranslatableFields($fieldConfig['form']['fields']);
//            }

            $this->formTranslatableFields[] = $fieldName;

        }

    }

    protected function extractInnerFieldsFromPage()
    {
        $pageMarkup = $this->pageObject->markup;
        $pageFieldsConfig = [];

        $parser = SyntaxParser::parse($pageMarkup);
        $pageFields = $parser->toEditor();

        foreach($pageFields as $fieldCode => $fieldConfig){

            if(!isset($fieldConfig['tab'])){
                $fieldConfig['tab'] = 'Conteudo';
            }

            if (isset($fieldConfig['type'] ) and $fieldConfig['type'] == 'repeater') {
                $fieldConfig['form']['fields'] = array_get($fieldConfig, 'fields', []);
                unset($fieldConfig['fields']);
            }

            $pageFieldsConfig[self::fistLevelPage.'[' . $fieldCode . ']'] = $fieldConfig;
        }

        return $pageFieldsConfig;
    }

    protected function loadPageData()
    {
        $pageUrl = $this->pageWrapper->getSettings('url');
        $contentData  = Conteudo::findPageContent($pageUrl);
        $pagina = Pagina::findPage($pageUrl);
        $pageData = [];

        if($pagina != null){
        	
        	$seoTitle 			= $pagina->seo_title;
        	$seoDescription 	= $pagina->seo_description;
        	
            $pageData['meta_title'] 		= $seoTitle;
            $pageData['meta_description'] 	= $seoDescription;
            
            $pageData['seo_title'] 			= $seoTitle;
            $pageData['seo_description'] 	= $seoDescription;
        }

        return [
            self::fistLevelPage => $contentData,
            'settings' 			=> $pageData
        ];
    }

    protected function extractOuterFieldsFromPage()
    {
        $outerFields = [

            'settings[seo_title]' => [

                'tab' => 'Seo',
                'label' => 'cms::lang.editor.meta_title',
                'default' => ''
            ],

            'settings[seo_description]' => [

                'tab' => 'Seo',
                'label' => 'cms::lang.editor.meta_description',
                'type' => 'textarea',
                'size' => 'tiny',
                'default' => ''
            ]
        ];

        return $outerFields;
    }
}
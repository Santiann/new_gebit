<?php namespace General\General\FormWidgets;

use Request;
use Backend\Classes\FormWidgetBase;

/**
 * Sitemap items widget.
 *
 * @package october\backend
 * @author Alexey Bobkov, Samuel Georges, H�lio Figueira
 */
class JsonRecordFinder extends FormWidgetBase
{
    //
    // Configurable properties
    //

    /**
     * @var string Field name to use for key.
     */
    public $keyFrom = 'id';

    /**
     * @var string Relation column to display for the name
     */
    public $nameFrom;

    /**
     * @var string Configurable yml that defines the fields
     */
    public $list = '';

    /**
     * @var string Relation column to display for the description
     */
    public $descriptionFrom;

    /**
     * @var string Prompt to display if no record is selected.
     */
    public $prompt = 'Click the %s button to find a record';

    /**
     * @var string Defines a model for search he records
     */
    public $modelName;

    /**
     * @var bool Define se o campo ser� impresso dentro de um repeater, ou n�o.
     */
    public $multiple = false;

    /**
     * @var array
     */
    public $listaModels = array();

    public $fieldsToShow = 'id';


    //
    // Object properties
    //

    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'jsonrecordfinder';

    /**
     * @var \Backend\Classes\WidgetBase Reference to the widget used for viewing (list or form).
     */
    protected $listWidget;

    /**
     * @var \Backend\Classes\WidgetBase Reference to the widget used for searching.
     */
    protected $searchWidget;


    /**
     * {@inheritDoc}
     */
    public function init()
    {
        $this->fillFromConfig([
            'prompt',
            'list',
            'keyFrom',
            'multiple',
            'modelName',
            'fieldsToShow',
        ]);

        $this->model = new $this->modelName;

        if (post('recordfinder_flag')) {

            $this->listWidget = $this->makeListWidget();
            $this->listWidget->bindToController();

            $this->searchWidget = $this->makeSearchWidget();
            $this->searchWidget->bindToController();

            /*
             * Link the Search Widget to the List Widget
             */
            $this->searchWidget->bindEvent('search.submit', function () {
                $this->listWidget->setSearchTerm($this->searchWidget->getActiveTerm());
                return $this->listWidget->onRefresh();
            });

            $this->searchWidget->setActiveTerm(null);
        }
    }

    /**
     * Fun��o invocada na redezi��o do pluguin
     * @return mixed
     * @throws \SystemException
     */
    public function render()
    {
        if(!is_array($this->formField->value))
        {
            $this->formField->value = json_decode($this->formField->value,true);
        }

        $this->loadModelValue($this->formField->value);
        $this->prepareVars();
        return $this->makePartial('container');
    }

    /**
     * Fun��o invocada cada vez que o plugin � atualizado
     * @return array
     * @throws \SystemException
     */
    public function onRefresh()
    {
        $this->loadModelValue(post($this->formField->getName()));
        $this->prepareVars();
        return ['#'.$this->getId('container') => $this->makePartial('recordfinder')];
    }

    /**
     * Fun��o que carrega a model com os dados enviados
     * @param $ref array
     */
    private function loadModelValue($ref)
    {
        $model = $this->modelName;
        $ref = is_array($ref) ? $ref : [] ;
        foreach($ref as $idReferencia)
        {
            $modelPopulada = $model::find( $idReferencia );
            if(!empty($modelPopulada)){
                $this->listaModels[] = $modelPopulada;
            }
        }
    }

    /**
     * Retorna um array de models selecionadas
     * @return \Backend\Classes\Model
     */
    public function getValue()
    {
        return $this->listaModels;
    }

    /**
     * Prepara todas as vari�veis que ser�o enviaddas para a view
     */
    public function prepareVars()
    {
        $this->vars['value']            = $this->getValue();

        $this->vars['chave']            = $this->keyFrom;
        $this->vars['fieldsToShow']     = explode('|',$this->fieldsToShow);

        $this->vars['field']            = $this->formField;
        $this->vars['listWidget']       = $this->listWidget;
        $this->vars['searchWidget']     = $this->searchWidget;

        $this->vars['prompt']           = str_replace('%s', '<i class="icon-th-list"></i>', $this->prompt);
    }

    /**
     * Fun��o utilizada para carregar os assets do plugin
     */
    public function loadAssets()
    {
        $this->addJs('js/recordfinder.js', 'core');
        $this->addJs('js/jquery-ui.min.js', 'core');
        $this->addCss('css/styles.css', 'core');
    }

    /**
     * Fun��o utilizada para recuperar o valor que ser� salvo em banco de dados.
     * @param \Backend\Classes\The $value
     * @return string
     */
    public function getSaveValue($value)
    {
        $toEncode = [];
        foreach($value as $chave => $item){
            if(!empty($item)){
                $toEncode[$chave] = $item;
            }
        }

        return json_encode($toEncode);
    }


    public function onFindRecord()
    {
        $this->prepareVars();
        return $this->makePartial('recordfinder_form');
    }

    protected function makeListWidget()
    {
        $config = $this->makeConfig($this->list);
        $config->model = $this->model;
        $config->alias = $this->alias . 'List';
        $config->showSetup = false;
        $config->showCheckboxes = false;
        $config->recordsPerPage = 20;
        $config->recordOnClick = sprintf("$('#%s').recordFinder('updateRecord', this, ':id')", $this->getId());
        $widget = $this->makeWidget('Backend\Widgets\Lists', $config);

        return $widget;
    }

    protected function makeSearchWidget()
    {
        $config = $this->makeConfig();
        $config->alias = $this->alias . 'Search';
        $config->growable = false;
        $config->prompt = 'backend::lang.list.search_prompt';
        $widget = $this->makeWidget('Backend\Widgets\Search', $config);
        $widget->cssClasses[] = 'recordfinder-search';

        return $widget;
    }

    public function onRemoveItem()
    {
        // Useful for deleting relations
    }

}
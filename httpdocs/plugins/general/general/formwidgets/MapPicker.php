<?php namespace General\General\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Event;
use Request;

/**
 * Map Picker
 * Renderiza um "mappicker" para captura de endere�os
 *
 * @package general\general
 * @author H�lio Figueira Junior <helio@general.com.br>
 */
class MapPicker extends FormWidgetBase
{

    public $radius = 0;

    public $form = [];

    public $showSearch = true;

    public $showAll= false;

    public $showMap = true;

    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'mappicker';

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        $this->fillFromConfig([
            'size',
            'radius',
            'form',
            'showSearch',
            'showMap'
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('mappicker');
    }

    /**
     * Prepares the list data
     */
    public function prepareVars()
    {
        $showForm                       = (!empty($this->form));
        $this->vars['showMap']          = isset($this->showMap) ? $this->showMap : true ;

        if($showForm){

            if($showForm == 'all')
            {
                $this->showAll = true;
            }
            else
            {
                $this->vars['fields']       = $this->form['fields'];
            }

            $this->vars['showForm']     = $showForm;
            $this->vars['readOnly']     = isset($this->form['readOnly']) ? $this->form['readOnly'] : false ;
        }

        $this->vars['showSearch']   = isset($this->showSearch) ? $this->showSearch : true;

        $this->vars['radius']       = $this->radius;
        $this->vars['size']         = $this->formField->size;
        $this->vars['name']         = $this->formField->getName();
        $this->vars['value']        = $this->getLoadValue();
    }

    /**
     * {@inheritDoc}
     */
    public function loadAssets()
    {
        $this->addJs('http://maps.google.com/maps/api/js?sensor=false&libraries=places');
        $this->addJs('js/locationpicker.js');
        $this->addJs('js/mappicker.js');
    }


    public function hasField($fieldName)
    {
        if($this->showAll)
        {
            return true;
        }
        return (isset($this->form['fields'][$fieldName]));
    }

    public function getValue($field, $default = false){

        return isset($this->getLoadValue()[$field]) ? $this->getLoadValue()[$field] : $default;

    }

}
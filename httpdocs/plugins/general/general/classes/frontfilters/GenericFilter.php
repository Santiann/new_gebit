<?php namespace General\General\Classes\FrontFilters;

use Cms\Classes\Partial;
use Cms\Classes\Theme;

/**
 * Helper para registar e processar os filtros
 */
abstract class GenericFilter
{

    // Attributes

    private $field;

    private $uniqueId;

    private $enabled = true;

    private $active;

    private $value;

    private $viewFile;

    private $component;

    private $data;

    // Methods

    public function __construct($field, $viewFile)
    {
        $this->field        = $field;
        $this->viewFile     = $viewFile;
    }

    public function setIdentifier($id)
    {
        $this->uniqueId = $id;
    }

    public function getIdentifier()
    {
        return $this->uniqueId;
    }

    public function disable()
    {
        $this->enabled = false;
    }

    public function enable()
    {
        $this->enabled  = true;
    }

    public function setValue($value)
    {
        $this->active = false;

        if($value != null && !empty($value))
        {
            $this->active = true;
        }

        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function render()
    {
        $viewFile = $this->viewFile;

        $this->addData('this', $this);
        $this->addData('value', $this->value);
        $this->addData('uniqueId', $this->uniqueId);

        return $this->component->renderPartial($viewFile, $this->data);
    }

    public function addData($index, $value)
    {
        $this->data[$index] = $value;
    }

    public function setComponent($component)
    {
        $this->component = $component;
    }

    public function getField()
    {
        return $this->field;
    }

    public function isActive()
    {
        return $this->active;
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    abstract function query($query);

    abstract function getValueLabel();

    public function getQueryString()
    {
        return 'filter['.$this->uniqueId.']='.$this->getValue();
    }

}

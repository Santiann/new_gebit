<?php namespace General\General\Classes\FrontFilters\FilterTypes;

use General\General\Classes\FrontFilters\GenericFilter;


class SelectFilter extends GenericFilter
{
    //Attributes

    private $options;

    // Methods

    public function __construct($field, $viewFile, array $options )
    {
        $this->options = $options;

        parent::__construct($field, $viewFile);
    }

    public function query($query)
    {
        $fieldValue = $this->getValue();

        if($fieldValue != null)
        {
            $fieldName = $this->getField();

            $query->where($fieldName,$fieldValue);
        }
    }

    public function render(){

        $this->addData('options', $this->options);

        return parent::render();
    }

    public function getValueLabel()
    {
        $valor = $this->getValue();
        return array_get($this->options,$valor,null);
    }

}

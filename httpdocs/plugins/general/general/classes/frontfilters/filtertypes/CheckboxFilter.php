<?php namespace General\General\Classes\FrontFilters\FilterTypes;

use General\General\Classes\FrontFilters\GenericFilter;


class CheckboxFilter extends GenericFilter
{
    //Attributes

    private $options;

    private $selectedOptions;

    // Methods

    public function __construct($field, $viewFile, array $options )
    {
        $this->options = $options;

        parent::__construct($field, $viewFile);
    }

    public function query($query)
    {
        $fieldValue = $this->getValue();

        $query->where(function($subquery) use ($fieldValue){

            foreach($this->options as $value =>  $label)
            {
                if(isset($fieldValue[$value]))
                {
                    $this->selectedOptions[$value] = $label;
                    $subquery->orWhere($this->getField(), $value);
                }
            }

        });
    }

    public function render(){

        $this->addData('options', $this->options);
        return parent::render();
    }

    public function getValueLabel()
    {
        $selectedValues = array_intersect_key($this->options,$this->getValue());
        return implode($selectedValues,', ');
    }

    public function getSelectedOptions()
    {
        return $this->selectedOptions;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function unSelect($optionId)
    {
        $fieldValues = $this->getValue();
        unset($fieldValues[$optionId]);
        $this->setValue($fieldValues);
    }

    public function getQueryString()
    {
        $queryString = '';
        $values = $this->getValue();

        foreach($values as $value){
            $queryString .= 'filter['.$this->getIdentifier().']='.$value.'&';
        }

        return $queryString;
    }

}

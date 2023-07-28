<?php namespace General\General\Classes\FrontFilters\FilterTypes;

use General\General\Classes\FrontFilters\GenericFilter;

/**
 * Classe que determina o filtro textual dentro do filter manager
 */
class TextFilter extends GenericFilter
{
    //Attributes

    private $fields;

    // Methods

    public function __construct($fields, $viewFile)
    {
        $this->fields = $fields;

        parent::__construct($fields, $viewFile);
    }

    public function query($query)
    {
        $fieldValue = $this->getValue();

        if(!empty($fieldValue))
        {
            $query->where(function($subQuery) use ($fieldValue){

                foreach($this->fields as $fieldName)
                {
                    $subQuery->orWhere($fieldName,'LIKE','%'.$fieldValue.'%');
                }

            });
        }
    }

    public function render(){

        return parent::render();
    }

    public function getValueLabel()
    {
        return $this->getValue();
    }


}

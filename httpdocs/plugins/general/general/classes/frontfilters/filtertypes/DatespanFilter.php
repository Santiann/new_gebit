<?php namespace General\General\Classes\FrontFilters\FilterTypes;

use General\General\Classes\FrontFilters\GenericFilter;
use Carbon\Carbon;

class DatespanFilter extends GenericFilter
{
    //Attributes

    private $fields;


    // Methods

    public function __construct($name, $viewFile )
    {

        parent::__construct($name, $viewFile);
    }

    public function query($query)
    {
        $lowerLimit = $this->getDate('start');
        $upperLimit = $this->getDate('end');

        // Pelo menos o limite inferior deve ser definido
        if($lowerLimit != null && $upperLimit != null)
        {

            $query->where(function($subquery) use ($lowerLimit, $upperLimit){

                $subquery->whereBetween($this->getField(), [$lowerLimit, $upperLimit] );

            });

        }

    }

    public function render(){


        return parent::render();
    }

    private function getDate($limit)
    {
        $fieldValue = $this->getValue();
        $date = array_get($fieldValue, $limit, null);
        if($date != null)
        {
            return Carbon::createFromFormat('d/m/Y', $date)->toDateString();
        }
    }

}

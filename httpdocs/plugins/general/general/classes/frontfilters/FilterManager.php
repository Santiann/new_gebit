<?php namespace General\General\Classes\FrontFilters;

/**
 * Helper para registar e processar os filtros
 */
class FilterManager
{
	// Properties

	private $filters;

	private $data;

	private $partialQuery;

	private $component;

	// Methods

	public function __construct(&$component, &$partialQuery)
	{
		$this->partialQuery =& $partialQuery;
		$this->component 	=& $component;

	}

	public function add($uniqueId, GenericFilter $filter)
	{
		$filter->setComponent($this->component);
		$filter->setIdentifier($uniqueId);

		$this->filters[$uniqueId] = $filter;

		$value = \Input::get('filter.'.$uniqueId);
		$filter->setValue($value);
	}

	public function with($uniqueId)
	{
		if(!isset($this->filters[$uniqueId]))
		{
			throw new \Exception("Não exite uma definição para um filtro com id '$uniqueId'", 1);
		}

		return $this->filters[$uniqueId];
	}

	public function getQuery()
	{
		$this->updateStatus($this->partialQuery);

		return $this->partialQuery;
	}

	private function updateStatus(&$partialQuery){

		foreach($this->filters as $uniqueId => $filter)
		{
			if($filter->isEnabled())
			{
				$filter->query($partialQuery);
			}
		}

	}

	public function open()
	{
		return '<form>';
	}

	public function close()
	{
		return '</form>';
	}

    public function asGetParams($append = '', $prepend = '')
    {

        $queryString    = $append;
        $first          = true;
        $separator      = '';

        foreach($this->filters as $filter)
        {
            if($filter->getValue() == ''){
                continue;
            }

            if($first)
            {
                $first      = false;
                $separator  = '&';
            }

            $queryString .= $separator . $filter->getQueryString();
            $separator  = '';
        }



        return $queryString . $prepend;
    }

}

<?php 
namespace General\General\Classes\Traits
{
	
	/**
	 * Trait para facilitar o uso da exclusão de vários itens simultâneamente
	 */
	trait BulkDelete
	{

	    /**
	     * Sobrebeescrita do método de exclusão padrão do OCTOBER
	     * @return mixed
	     */
	    public function index_onDelete()
	    {
	        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

                $modelClass = $this->asExtension('ListController')->getConfig('modelClass');

	            foreach ($checkedIds as $itemId) {
	                if ((!$objectItem = $modelClass::find($itemId)))
	                    continue;

	                $objectItem->delete();
	            }

	            \Flash::success('Itens removidos com sucesso !');
	        }else{

	        	\Flash::warning('Nenhum item foi selecionado');
	        }

	        return $this->listRefresh();
	    }
	}

	
}
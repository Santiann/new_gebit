<?php
/**
 * Created by PhpStorm.
 * User: helio
 * Date: 25/11/15
 * Time: 09:48
 */

namespace General\General\Classes\Traits;


use League\Flysystem\Exception;
use October\Rain\Exception\ApplicationException;

trait ListItemPublish
{
    //public $listPublishColumns = 'column_name';

    public $listSuccessMessages = 'Status alterado com Sucesso !';

    public $listErrorMessages   = 'Ocorreu algum erro ao alterar o status, contate nosso suporte !';

    public function index_onStatusChange()
    {
        $keyName        = post('keyName','id');
        $keyValue       = post('keyValue');
        $columnName     = post('columnName');
        $columnValue    = post('columnValue');

        try{
            $model = $this->asExtension('ListController')->getConfig('modelClass');

            $item = $model::where($keyName,$keyValue)->firstOrFail();
            $item->$columnName = ($columnValue == 'on' ) ? 1 : 0;
            $item->save();

            \Flash::success($this->getSuccessMessage($columnName));
            return $this->listRefresh();
        }
        catch(\Exception $error)
        {
            \Flash::error($this->getErrorMessage($columnName));
        }
    }

    public function renderPublishButton($value, $id, $identifier = null)
    {
        return view('general.general::listitempublish.switch',[
            'value' => $value,
            'id' => $id,
            'columnName' => $this->getColumnName($identifier)
        ]);
    }

    private function getSuccessMessage($item)
    {
        if(!is_array($this->listSuccessMessages))
        {
            return $this->listSuccessMessages;
        }

        if(isset($this->listSuccessMessages[$item]))
        {
            return $this->listSuccessMessages[$item];
        }
        else
        {
            throw new Exception('Sucess message key must match a field name');
        }
    }

    private function getErrorMessage($item)
    {
        if(!is_array($this->listErrorMessages))
        {
            return $this->listErrorMessages;
        }

        if(isset($this->listErrorMessages[$item]))
        {
            return $this->listErrorMessages[$item];
        }
        else
        {
            throw new Exception('Sucess message key must match a field name');
        }
    }

    private function getColumnName($identifier)
    {
        if($identifier == null and is_string($this->listPublishColumns))
        {
            return $this->listPublishColumns;
        }

        if(isset($this->listPublishColumns[$identifier]))
        {
            return $this->listPublishColumns[$identifier];
        }

        throw new ApplicationException('The system was unable to determina with field it should load');

    }
}
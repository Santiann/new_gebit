<?php namespace General\Paginas\Controllers;

use General\Paginas\Models\Pagina;
use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Lang;
use System\Classes\SettingsManager;

/**
 * Classe para o controle das confirguira��es salvas em banco
 * Class Configuracoes
 * @package General\Paginas\Controllers
 */
class Configuracoes extends Controller
{
    //Implementa��es padr�o do October
    public $implement = [
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.RelationController',
    ];

    //Defini��o da configura��o da Lista
    public $listConfig          = 'config_list.yaml';

    //Defini��o da configura��o do Formul�rio
    public $formConfig          = 'config_form.yaml';

    //Defini��o da configura��o do Relacionamento
    public $relationConfig      = 'config_relation.yaml';

    //Defini��o de quais permiss�es s�o necess�rias para acesso da p�gina
    public $requiredPermissions = ['general.paginas.settings'];

    /////////////////////////////////////////////////   METHODS   //////////////////////////////////////////////////////

    /**
     * Sobreescrita do construtor
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('General.Paginas', 'paginas');

    }

    /**
     * Sobrebeescrita do m�todo de exclus�o padr�o do OCTOBER
     * @return mixed
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $paginasId) {

                if ((!$pagina = Pagina::find($paginasId)))
                    continue;

                $pagina->delete();
            }

            Flash::success('Pagina(s) removidas com sucesso !');
        }

        return $this->listRefresh();
    }

}
<?php namespace Dealix\Faqs\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use \League\Csv\Writer;
use Dealix\Faqs\Models\Faq;
use Flash;
use Lang;
use Schema;

/**
 * Classe para controle do CRUD
 * Class Faqs
 * @package Dealix\faqs\Controllers
 */
class Faqs extends Controller
{
    public $implement = [
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.FormController'
    ];

    public $listConfig          = 'config_list.yaml';
    public $formConfig          = 'config_form.yaml';
    public $requiredPermissions = ['dealix.faqs.faqs'];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Dealix.faqs', 'faqs', 'faqs');
    }


    /**
     * Sobrebeescrita do m�todo de exclus�o padr�o do OCTOBER
     * @return mixed
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $mailId) {
                if ((!$mail = Faq::find($mailId)))
                    continue;

                $mail->delete();
            }

            Flash::success('Faq(s) removidas com sucesso !');
        }

        return $this->listRefresh();
    }
}

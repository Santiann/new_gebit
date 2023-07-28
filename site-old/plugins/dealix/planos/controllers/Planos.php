<?php namespace Dealix\Planos\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use \League\Csv\Writer;
use Dealix\Planos\Models\Plano;
use Flash;
use Lang;
use Schema;

/**
 * Classe para controle do CRUD
 * Class Planos
 * @package Dealix\Planos\Controllers
 */
class Planos extends Controller
{
    public $implement = [
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.FormController'
    ];

    public $listConfig          = 'config_list.yaml';
    public $formConfig          = 'config_form.yaml';
    public $requiredPermissions = ['dealix.planos.plano'];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Dealix.Planos', 'planos', 'plano');
    }
}

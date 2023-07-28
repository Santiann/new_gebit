<?php namespace Dealix\Faq\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * FaqGroups Back-end Controller
 */
class Groups extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $relationConfig = 'config_relation.yaml';

    public $requiredPermissions = ['dealix.faq.groups'];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Dealix.Faq', 'faq', 'groups');
    }
}

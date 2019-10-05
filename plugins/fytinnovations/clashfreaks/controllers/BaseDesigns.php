<?php namespace Fytinnovations\ClashFreaks\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Base Designs Back-end Controller
 */
class BaseDesigns extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Fytinnovations.ClashFreaks', 'clashfreaks', 'basedesigns');
    }
}

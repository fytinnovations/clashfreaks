<?php namespace Fytinnovations\ClashFreaks\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Village Types Back-end Controller
 */
class VillageTypes extends Controller
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

        BackendMenu::setContext('Fytinnovations.ClashFreaks', 'clashfreaks', 'villagetypes');
    }

}

<?php namespace Fytinnovations\ClashFreaks\Components;

use Cms\Classes\ComponentBase;
use Fytinnovations\ClashFreaks\Classes\ClashAPIAdapter as ClashRequest;

class TopHomeVillageClanList extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'TopHomeVillageClanList Component',
            'description' => 'Displays a list of top players in a location'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun(){
        ClashRequest::getTopPlayers();
    }
}

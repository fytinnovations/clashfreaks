<?php namespace Fytinnovations\ClashFreaks\Components;

use Cms\Classes\ComponentBase;
use Fytinnovations\ClashFreaks\Classes\ClashOfClans;

class TopHomeVillageClanList extends ComponentBase
{
    private $request;

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

    public function init(){
        $this->request = new ClashOfClans;
    }

    public function onRun(){
        dd($this->request->getTopPlayers());
    }
}

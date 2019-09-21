<?php

namespace Fytinnovations\ClashFreaks\Components;

use Cms\Classes\ComponentBase;
use Fytinnovations\ClashFreaks\Classes\ClashOfClans;


class TopBuilderVillagePlayerList extends ComponentBase
{
    private $request;

    public function componentDetails()
    {
        return [
            'name'        => 'TopBuilderVillagePlayerList Component',
            'description' => 'Displays a list of top players in a location'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function init()
    {
        $this->request = new ClashOfClans;
    }

    public function locations()
    {
        return $this->request->getLocations();
    }

    public function players()
    {
        return $this->request->getTopBuilderPlayers();
    }

    public function onFilter()
    {
        $locationId = post('location_id');
        $players = $this->request->getTopBuilderPlayers($locationId);
        return ['#top_builder_players_list' => $this->renderPartial('@list.htm', ['players' => $players->items??NULL])];
    }

}

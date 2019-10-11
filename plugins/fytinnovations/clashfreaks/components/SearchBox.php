<?php

namespace Fytinnovations\ClashFreaks\Components;

use Cms\Classes\ComponentBase;
use Fytinnovations\ClashFreaks\Classes\ClashOfClans;

class SearchBox extends ComponentBase
{
    private $request;

    public function componentDetails()
    {
        return [
            'name'        => 'PlayerProfile Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function init()
    {
        $this->request = new ClashOfClans;
    }

    public function defineProperties()
    {
        return [];
    }

    public function onPlayerSearch()
    {
        $tag = post('player_tag');
        try {
            $player = $this->request->getPlayerProfile($tag);
        } catch (\Throwable $err) {
            return ['#player_search_list' => "<p class='bg-danger'>" . $err->getMessage() . "</p>"];
        }
        return ['#player_search_list' => $this->renderPartial('@player_search_list.htm', ['player' => $player])];
    }

    public function onClanSearch()
    {
        $clan_name = post('clan_name');
        $location_id = post('location_id');
        try {
            $clans = $this->request->searchClans($clan_name, $location_id);
        } catch (\Throwable $err) {
            return ['#clan_search_list' => "<p class='bg-danger'>" . $err->getMessage() . "</p>"];
        }
        
        return ['#clan_search_list' => $this->renderPartial('@clan_search_list.htm', ['clans' => $clans->items])];
    }

    public function locations()
    {
        return $this->request->getLocations();
    }
}

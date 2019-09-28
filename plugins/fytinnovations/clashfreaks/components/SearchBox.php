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
        $player = $this->request->getPlayerProfile($tag);
        return ['#player_search_list' => $this->renderPartial('@player_search_list.htm', ['player' => $player])];
    }

    public function onClanSearch()
    {
        $clan_name = post('clan_name');
        $clans = $this->request->searchClans($clan_name);
        return ['#clan_search_list' => $this->renderPartial('@clan_search_list.htm', ['clans' => $clans->items])];
    }

}

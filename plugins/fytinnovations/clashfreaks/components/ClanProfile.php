<?php namespace Fytinnovations\ClashFreaks\Components;

use Cms\Classes\ComponentBase;
use Fytinnovations\ClashFreaks\Classes\ClashOfClans;
use Auth;
use Fytinnovations\ClashFreaks\Models\FavoriteClan;

class ClanProfile extends ComponentBase
{
    private $request;

    public function componentDetails()
    {
        return [
            'name'        => 'ClanProfile Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function init(){
        $this->request = new ClashOfClans;
    }

    public function defineProperties()
    {
        return [];
    }

    public function clan(){
        $slug = $this->param('tag');
        $data= $this->request->getClanProfile($slug);
        return $data;
    }

    public function onAddToFavorite(){
        $slug = $this->param('tag');
        $favorite_clan=FavoriteClan::firstOrNew([
            'clan_tag'                 => $slug,
        ]);
        return Auth::getUser()->favorite_clans()->add($favorite_clan);
    }

}

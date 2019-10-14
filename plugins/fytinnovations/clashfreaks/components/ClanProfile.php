<?php

namespace Fytinnovations\ClashFreaks\Components;

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

    public function init()
    {
        $this->request = new ClashOfClans;
    }

    public function defineProperties()
    {
        return [];
    }


    public function isFavorite()
    {
        $slug = $this->param('tag');
        if (Auth::getUser()->favorite_clans()->where('clan_tag', $slug)->first()) {
            return true;
        }
        return false;
    }
    public function clan()
    {
        $slug = $this->param('tag');
        $data = $this->request->getClanProfile($slug);
        return $data;
    }

    public function onAddToFavorite()
    {
        $slug = $this->param('tag');
        $favorite_clan = FavoriteClan::firstOrNew([
            'clan_tag'                 => $slug,
        ]);
        Auth::getUser()->favorite_clans()->add($favorite_clan);
        return ['#favorite_btns' => $this->renderPartial('@favorite.htm', ['isFavorite' => 1, 'user' => Auth::getUser()])];
    }

    public function onDelete()
    {
        $slug = $this->param('tag');
        $favorite_clan = FavoriteClan::where([
            'clan_tag' => $slug,
            'user_id' => Auth::getUser()->id
        ])->first();
        $favorite_clan->delete();
        return ['#favorite_btns' => $this->renderPartial('@favorite.htm', ['isFavorite' => 0, 'user' => Auth::getUser()])];
    }
}

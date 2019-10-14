<?php

namespace Fytinnovations\ClashFreaks\Components;

use Cms\Classes\ComponentBase;
use Fytinnovations\ClashFreaks\Classes\ClashOfClans;
use Fytinnovations\ClashFreaks\Models\FavoritePlayer;
use Auth;

class PlayerProfile extends ComponentBase
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

    public function isFavorite()
    {
        $slug = $this->param('tag');
        if (Auth::getUser()->favorite_players()->where('player_tag', $slug)->first()) {
            return true;
        }
        return false;
    }

    public function defineProperties()
    {
        return [];
    }

    public function player()
    {
        $slug = $this->param('tag');
        $data = $this->request->getPlayerProfile($slug);
        return $data;
    }

    public function onAddToFavorite()
    {
        $slug = $this->param('tag');
        $favorite_player = FavoritePlayer::firstOrNew([
            'player_tag'                 => $slug,
        ]);
        Auth::getUser()->favorite_players()->add($favorite_player);
        return ['#favorite_btns' => $this->renderPartial('@favorite.htm', ['isFavorite' => 1, 'user' => Auth::getUser()])];
    }

    public function onDelete()
    {
        $slug = $this->param('tag');
        $favorite_clan = FavoritePlayer::where([
            'player_tag' => $slug,
            'user_id' => Auth::getUser()->id
        ])->first();
        $favorite_clan->delete();
        return ['#favorite_btns' => $this->renderPartial('@favorite.htm', ['isFavorite' => 0, 'user' => Auth::getUser()])];
    }


}

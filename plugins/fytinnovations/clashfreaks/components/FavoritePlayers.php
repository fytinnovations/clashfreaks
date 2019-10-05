<?php

namespace Fytinnovations\ClashFreaks\Components;

use Auth;
use Cms\Classes\ComponentBase;
use Fytinnovations\ClashFreaks\Classes\ClashOfClans;
use Fytinnovations\ClashFreaks\Models\FavoritePlayer;

class FavoritePlayers extends ComponentBase
{
    private $request;

    private $user;

    public function componentDetails()
    {
        return [
            'name'        => 'FavoritePlayers Component',
            'description' => 'Displays a list of favorite players of logged in user'
        ];
    }
    public function init()
    {
        $this->request = new ClashOfClans;
        $this->user= Auth::getUser();
    }
    public function defineProperties()
    {
        return [];
    }


    public function favoritePlayers()
    {
        $favorite_players = $this->user->favorite_players;
        $result = collect();
        foreach ($favorite_players as $player) {
            $player= $this->request->getPlayerProfile($player->player_tag);
            $result->push($player);
        }
        return $result;
    }

    public function onDelete(){
        $player_tag= post('tag');
        $favorite_player=FavoritePlayer::where([
            'player_tag'=> $player_tag,
            'user_id'=>$this->user->id
        ])->first();
        $favorite_player->delete();
        $favorite_players=$this->favoritePlayers();
        return ['#favorite_player_list' => $this->renderPartial('@list.htm', ['players' => $favorite_players??NULL])];
    }
}

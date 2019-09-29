<?php namespace Fytinnovations\ClashFreaks\Components;

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

    public function init(){
        $this->request = new ClashOfClans;
    }

    public function defineProperties()
    {
        return [];
    }

    public function player(){
        $slug = $this->param('tag');
        $data= $this->request->getPlayerProfile($slug);
        return $data;
    }

    public function onAddToFavorite(){
        $slug = $this->param('tag');
        $favorite_player=FavoritePlayer::firstOrNew([
            'player_tag'                 => $slug,
        ]);
        return Auth::getUser()->favorite_players()->add($favorite_player);
    }

}

<?php namespace Fytinnovations\ClashFreaks\Components;

use Cms\Classes\ComponentBase;
use Auth;
use Fytinnovations\ClashFreaks\Classes\ClashOfClans;
use Fytinnovations\ClashFreaks\Models\FavoriteClan;

class FavoriteClans extends ComponentBase
{
    private $user;

    private $request;

    public function componentDetails()
    {
        return [
            'name'        => 'FavoriteClans',
            'description' => 'Display a list of favorite clans of the logged in user'
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

    public function favoriteClans()
    {
        $favorite_clans = $this->user->favorite_clans;
        $result = collect();
        foreach ($favorite_clans as $clan) {
            $clan= $this->request->getClanProfile($clan->clan_tag);
            $result->push($clan);
        }
        return $result;
    }

    public function onDelete(){
        $clan_tag= post('tag');
        $favorite_clan=FavoriteClan::where([
            'clan_tag'=> $clan_tag,
            'user_id'=>$this->user->id
        ])->first();
        $favorite_clan->delete();
        $favorite_clans=$this->favoriteClans();
        return ['#favorite_clan_list' => $this->renderPartial('@list.htm', ['clans' => $favorite_clans??NULL])];
    }
}

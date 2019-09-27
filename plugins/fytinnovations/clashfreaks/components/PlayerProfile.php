<?php namespace Fytinnovations\ClashFreaks\Components;

use Cms\Classes\ComponentBase;
use Fytinnovations\ClashFreaks\Classes\ClashOfClans;

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

}

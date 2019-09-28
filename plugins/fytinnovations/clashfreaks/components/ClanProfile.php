<?php namespace Fytinnovations\ClashFreaks\Components;

use Cms\Classes\ComponentBase;
use Fytinnovations\ClashFreaks\Classes\ClashOfClans;

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

}

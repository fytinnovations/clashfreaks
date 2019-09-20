<?php namespace Fytinnovations\ClashFreaks\Components;

use Cms\Classes\ComponentBase;
use Fytinnovations\ClashFreaks\Classes\ClashOfClans;

class TopHomeVillageClanList extends ComponentBase
{
    private $request;

    public function componentDetails()
    {
        return [
            'name'        => 'TopHomeVillageClanList Component',
            'description' => 'Displays a list of top players in a location'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function init(){
        $this->request = new ClashOfClans;
    }

    public function locations(){
        return $this->request->getLocations();
    }

    public function clans(){
        $clans=$this->request->getTopClans();
        $this->page['after_home_clan_list']=$clans->paging->cursors->after;
        return $clans;
    }

    public function onFilter(){
        $locationId=post('location_id');
        $clans=$this->request->getTopClans($locationId);
        $this->page['before_home_clan_list']=$clans->paging->cursors->before;
        $this->page['after_home_clan_list']=$clans->paging->cursors->after;

        return ['#top_clans_list' =>$this->renderPartial('@list.htm',['clans'=>$clans->items])];
    }

    public function onPaginate(){
        $clans=$this->request->getTopClans(post('location_id'));
        $this->page['before_home_clan_list']=$clans->paging->cursors->before;
        $this->page['after_home_clan_list']=$clans->paging->cursors->after;
    }

}

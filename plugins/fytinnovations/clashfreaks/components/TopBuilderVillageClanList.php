<?php namespace Fytinnovations\ClashFreaks\Components;

use Cms\Classes\ComponentBase;
use Fytinnovations\ClashFreaks\Classes\ClashOfClans;

class TopBuilderVillageClanList extends ComponentBase
{
    private $request;

    public function componentDetails()
    {
        return [
            'name'        => 'TopBuilderVillageClanList Component',
            'description' => 'Displays a list of top clans in a location'
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
        return $this->request->getTopBuilderClans();
    }

    public function onFilter(){ 
        $locationId=post('location_id');
        $clans=$this->request->getTopBuilderClans($locationId);
        return ['#top_builder_clans_list' =>$this->renderPartial('@list.htm',['clans'=>$clans->items])];
    }

}

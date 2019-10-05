<?php

namespace Fytinnovations\ClashFreaks\Components;

use Cms\Classes\ComponentBase;
use Fytinnovations\ClashFreaks\Models\VillageType;
use Fytinnovations\ClashFreaks\Models\TownHall;
use Fytinnovations\ClashFreaks\Models\BaseDesign;
use Input;
use October\Rain\Support\Facades\Flash;

class UploadBase extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'UploadBase Component',
            'description' => 'Create a form to allow base upload'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function village_types(){
        return VillageType::all();
    }

    public function town_halls(){
        return TownHall::where('village_type_id',1)->get();
    }

    public function onVillageTypeChange(){
        $village_type = post('village_type');
        $town_halls = TownHall::where('village_type_id',$village_type)->get();
        return ['#base_th_level_inp' =>$this->renderPartial('@town_hall_list.htm',['town_halls'=>$town_halls])];
    }

    public function onBaseUpload(){
        $baseDesign = new BaseDesign();
        $baseDesign->name= post('name');
        $baseDesign->description=post('description');
        $baseDesign->url= post('url');
        $baseDesign->town_hall_id=post('town_hall');
        $baseDesign->images= Input::file('images');
        $baseDesign->save();
        Flash::success("Thankyou for contributing we will upload the base after reviewing it.");
    }

}

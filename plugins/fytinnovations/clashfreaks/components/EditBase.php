<?php

namespace Fytinnovations\ClashFreaks\Components;

use Cms\Classes\ComponentBase;
use Fytinnovations\ClashFreaks\Models\VillageType;
use Fytinnovations\ClashFreaks\Models\TownHall;
use Fytinnovations\ClashFreaks\Models\BaseDesign;
use October\Rain\Support\Facades\Flash;
use Input;

class EditBase extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'EditBase Component',
            'description' => 'Create a form to allow base upload'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function village_types()
    {
        return VillageType::all();
    }

    public function town_halls()
    {
        return TownHall::where('village_type_id', 1)->get();
    }

    public function onVillageTypeChange()
    {
        $village_type = post('village_type');
        $town_halls = TownHall::where('village_type_id', $village_type)->get();
        return ['#base_th_level_inp' => $this->renderPartial('@town_hall_list.htm', ['town_halls' => $town_halls])];
    }

    public function onBaseUpdate()
    {
        $baseDesign = BaseDesign::where('slug',$this->param('slug'))->first();
        $baseDesign->description = post('description');
        $baseDesign->url = post('url');
        $baseDesign->town_hall_id = post('town_hall');
        if(Input::file('photo-mode')){
            $baseDesign->photo_mode= Input::file('photo-mode');
        }else if(Input::file('wall-mode')){
            $baseDesign->wall_mode= Input::file('wall-mode');
        }else if(Input::file('scout-mode')){
            $baseDesign->scout_mode= Input::file('scout-mode');
        }
        $baseDesign->save();
        Flash::success("Your base has been updated.");
    }

    public function basedesign(){
        return BaseDesign::where('slug',$this->param('slug'))->first();
    }
}

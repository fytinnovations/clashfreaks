<?php namespace Fytinnovations\ClashFreaks\Components;

use Cms\Classes\ComponentBase;
use Fytinnovations\ClashFreaks\Models\BaseDesign;
use Fytinnovations\ClashFreaks\Models\BaseRating;
use Auth;

class BaseDesignInfo extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'BaseInfo',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function baseInfo(){
        $slug=$this->param('slug');
        return BaseDesign::where('slug',$slug)->with('created_by')->firstOrFail();
    }

    public function onRateBase(){
        $user = Auth::getUser();
        $baseRating= BaseRating::firstOrNew(['user_id' => $user->id,'base_design_id'=>post('baseId')]);
        $baseRating->ratings=post('ratedStars');
        $baseRating->save();
    }
}

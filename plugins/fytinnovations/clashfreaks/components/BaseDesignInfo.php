<?php namespace Fytinnovations\ClashFreaks\Components;

use Cms\Classes\ComponentBase;
use Fytinnovations\ClashFreaks\Models\BaseDesign;
use Auth;

class BaseDesignInfo extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'BaseInfo Component',
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
    }
}
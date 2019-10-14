<?php namespace Fytinnovations\ClashFreaks\Components;

use Cms\Classes\ComponentBase;
use Fytinnovations\ClashFreaks\Models\BaseDesign;

class BaseDesignList extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'BaseDesignList',
            'description' => 'Displays a list of base designs'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function baseDesigns(){
        return BaseDesign::where('is_active',1)->paginate(5);
    }
}

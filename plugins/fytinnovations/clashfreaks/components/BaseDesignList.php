<?php

namespace Fytinnovations\ClashFreaks\Components;

use Cms\Classes\ComponentBase;
use Fytinnovations\ClashFreaks\Models\BaseDesign;
use Auth;
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
        return [
            'filterByUser' => [
                'title'             => 'Filter By User',
                'description'       => 'Allowing this will older filter bases according to frontend users',
                'default'           => false,
                'type'              => 'boolean',
            ]
        ];
    }

    public function onRun(){
    }

    public function baseDesigns()
    {
        if($this->property('filterByUser')){
            $user= Auth::getUser();
            return $user->basedesigns_created()->paginate(5);
        }
        return BaseDesign::where('is_active', 1)->paginate(5);
    }
}

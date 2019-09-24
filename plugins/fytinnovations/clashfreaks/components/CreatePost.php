<?php namespace Fytinnovations\ClashFreaks\Components;

use Cms\Classes\ComponentBase;
use RainLab\Blog\Models\Category;

class CreatePost extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'CreatePost Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function categories(){
        return Category::all();
    }
}

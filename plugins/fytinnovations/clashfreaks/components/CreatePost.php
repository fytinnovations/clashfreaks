<?php namespace Fytinnovations\ClashFreaks\Components;

use Auth;
use Cms\Classes\ComponentBase;
use October\Rain\Support\Facades\Flash;
use RainLab\Blog\Models\Category;
use RainLab\Blog\Models\Post;
use Input;

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

    public function onPost(){
        $post = new Post;
        $post->title= post('title');
        $post->slug=str_slug($post->title);
        $post->content="Yet to upload";
        $post->raw_file= Input::file('raw_file');
        $post->user= Auth::getUser();
        $post->save();
        $post->categories()->attach(post('category'));
        Flash::success('Your post has been uploaded. We will publish it after verification');
    }
}

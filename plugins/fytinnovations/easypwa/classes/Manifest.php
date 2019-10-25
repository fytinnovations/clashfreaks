<?php namespace Fytinnovations\EasyPWA\Classes;

use Fytinnovations\EasyPWA\Models\Settings;

class Manifest
{
    private $attributes=[
        "name"=>"",
        "short_name"=>"",
        "display"=>"",
        "start_url"=>"",
        "theme_color"=>"",
        "background_color"=>"",
        "icons"=>[]
    ];

    public function get(){
        return \json_encode($this->attributes);
    }

    public function generate()
    {
        $settings = Settings::instance();
        foreach ($this->attributes as $key=>$value) {
           if($key=="icons"){
               $icon= new \stdClass();
               $storedIcon= $settings->icon;
               $path=storage_path('app/'. $storedIcon->getDiskPath());
               list($width, $height) = getimagesize($path);
               $icon->src= $storedIcon->getPath();
               $icon->sizes=$width."x".$height;
               $icon->type= $storedIcon->getContentType();
               array_push($this->attributes["icons"],$icon);
               break;
           }
           $this->attributes[$key]=$settings->$key;
        }
        return $this;
    }

}


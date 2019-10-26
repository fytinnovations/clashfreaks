<?php namespace Fytinnovations\EasyPWA\Classes;

use Fytinnovations\EasyPWA\Models\Settings;
use stdClass;

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
        $icon = new stdClass;
        foreach ($this->attributes as $key=>$value) {
           if($key=="icons"){
               $icon->src= "https://clashfreaks.test/themes/clashfreaks/assets/img/logo.jpg";
               $icon->sizes="192x192";
               $icon->type= "image/png";
               break;
           }
           $this->attributes[$key]=$settings->$key;
        }
        
        return $this;
    }

}


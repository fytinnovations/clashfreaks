<?php namespace Fytinnovations\EasyPWA\Components;

use Cms\Classes\ComponentBase;
use PWAManifest;

class PWATags extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'PWATags Component',
            'description' => 'Inserts all tags for PWA'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function themeColor(){
        return PWAManifest::get()["theme_color"];
    }

    public function appName(){
        return PWAManifest::get()["name"];
    }

    public function iosIcon(){
        return PWAManifest::getIosIconPath();
    }

}

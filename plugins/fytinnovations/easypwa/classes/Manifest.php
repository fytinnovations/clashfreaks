<?php

namespace Fytinnovations\EasyPWA\Classes;

use Fytinnovations\EasyPWA\Models\Settings;
use stdClass;

class Manifest
{
    private $attributes = [
        "name" => "",
        "short_name" => "",
        "display" => "",
        "start_url" => "",
        "theme_color" => "",
        "background_color" => "",
        "orientation"=>"",
        "icons" => []
    ];

    public function get()
    {
        return $this->attributes;
    }

    public function generate()
    {
        $settings = Settings::instance();
        foreach ($this->attributes as $key => $value) {
            if ($key == "icons") {
                foreach ($settings->icons as $icon) {
                    $tempIcon = new stdClass;
                    $path=storage_path('app/'. $icon->getDiskPath());
                    list($width, $height) = getimagesize($path);
                    $tempIcon->src = $icon->getPath();
                    $tempIcon->sizes =$width."x".$height;
                    $tempIcon->type = $icon->getContentType();
                    array_push($this->attributes['icons'],$tempIcon);
                };
                break;
            }
            $this->attributes[$key] = $settings->$key;
        }

        return $this;
    }
}

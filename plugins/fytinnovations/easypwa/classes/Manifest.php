<?php

namespace Fytinnovations\EasyPWA\Classes;

use Fytinnovations\EasyPWA\Models\Settings;
use stdClass;
use Cache;
class Manifest
{
    private $attributes = [
        "name" => "",
        "short_name" => "",
        "display" => "",
        "start_url" => "",
        "theme_color" => "",
        "background_color" => "",
        "orientation" => "",
        "icons" => [],
        ""
    ];

    public function get()
    {
        return $this->attributes;
    }
    

    /**
     * Generates a manifest array and caches it for 10 minutes
     *
     * @return object
     */
    public function generate()
    {
        $response = Cache::remember("pwaManifest", now()->addMinutes(10), function () {
            $settings = Settings::instance();
            foreach ($this->attributes as $key => $value) {
                if ($key == "icons") {
                    foreach ($settings->icons as $icon) {
                        $tempIcon = new stdClass;
                        $path = storage_path('app/' . $icon->getDiskPath());
                        list($width, $height) = getimagesize($path);
                        $tempIcon->src = $icon->getPath();
                        $tempIcon->sizes = $width . "x" . $height;
                        $tempIcon->type = $icon->getContentType();
                        array_push($this->attributes['icons'], $tempIcon);
                    };
                    break;
                }
                $this->attributes[$key] = $settings->$key;
            }
            return $this;
        });
        return $response;
    }

    public function getIosIconPath(){
        return Settings::instance()->ios_icon->getPath();
    }
}

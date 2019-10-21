<?php namespace Zen\Robots\Controllers;

use Request;
use Zen\Robots\Models\Settings;

class Generate
{
    public static function robots()
    {
        $domain = self::getDomain();
        $content = Settings::get('content');
        $content = str_replace('$domain', $domain, $content);
        return $content;
    }

    public static function getDomain ()
    {
        if (Request::secure())
        {
            return 'https://'.$_SERVER['HTTP_HOST'];
        } else {
            return 'http://'.$_SERVER['HTTP_HOST'];
        }
    }
}

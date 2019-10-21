<?php namespace Zen\Robots;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'Robots.txt',
            'description' => 'zen.robots::lang.plugin.description',
            'author'      => 'Alexander Ablizin',
            'icon'        => 'icon-leaf'
        ];
    }

    public function registerPermissions()
    {
        return [
            'zen.robots' => [
                'tab'   => 'robots.txt',
                'label' => 'zen.robots::lang.perms.access'
            ],
        ];
    }

    public function registerSettings()
    {
        return [
            'options' => [
                'label'       => 'Robots.txt',
                'description' => 'zen.robots::lang.plugin.description',
                'icon'        => 'icon-android',
                'permissions' => ['zen.robots'],
                'class' => 'Zen\Robots\Models\Settings',
                'order' => 600,
                'category'    => 'SEO'
            ]
        ];
    }
}

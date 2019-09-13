<?php namespace Fytinnovations\ClashFreaks;

use System\Classes\PluginBase;
use Backend;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }

    public function pluginDetails()
    {
        return [
            'name' => 'fytinnovations.clashfreaks::lang.plugin.name',
            'description' => 'fytinnovations.clashfreaks::lang.plugin.description',
            'author' => 'Fytinnovations',
            'icon' => 'oc-icon-users'
        ];
    }

    public function registerNavigation()
    {
        return [
            'clashfreaks' => [
                'label'       => 'fytinnovations.clashfreaks::lang.plugin.name',
                'url'         => Backend::url('fytinnovations/clashfreaks/basedesigns'),
                'icon'        => 'oc-icon-users',
                'sideMenu' => [
                    'basedesigns' => [
                        'label'       => 'Base Designs',
                        'icon'        => 'icon-copy',
                        'url'         => Backend::url('fytinnovations/clashfreaks/basedesigns'),
                    ],
                    'villagetypes' => [
                        'label'       => 'Village Types',
                        'icon'        => 'icon-copy',
                        'url'         => Backend::url('fytinnovations/clashfreaks/villagetypes'),
                    ],
                    'townhalls' => [
                        'label'       => 'Town Halls',
                        'icon'        => 'icon-copy',
                        'url'         => Backend::url('fytinnovations/clashfreaks/townhalls'),
                    ]
                ]
            ]
        ];
    }

}

<?php namespace Fytinnovations\ClashFreaks;

use System\Classes\PluginBase;
use Backend;
use RainLab\User\Models\User as FrontEndUser;
use Backend\Models\User as BackendUser;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Fytinnovations\ClashFreaks\Components\BaseDesignList'=>"baseDesignList",
            'Fytinnovations\ClashFreaks\Components\BaseDesignInfo'=>"baseDesignInfo",
            'Fytinnovations\ClashFreaks\Components\TopHomeVillageClanList'=>"topHomeVillageClanList",
        ];
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

    public function boot(){
        FrontendUser::extend(function($model) {
            $model->morphMany=[
                'basedesigns_created' => ['Fytinnovations\ClashFreaks\Models\BaseDesign', 'name' => 'created_by'],
                'basedesigns_updated' => ['Fytinnovations\ClashFreaks\Models\BaseDesign', 'name' => 'updated_by']
            ];
        });
        BackendUser::extend(function($model) {
            $model->morphMany=[
                'basedesigns_created' => ['Fytinnovations\ClashFreaks\Models\BaseDesign', 'name' => 'created_by'],
                'basedesigns_updated' => ['Fytinnovations\ClashFreaks\Models\BaseDesign', 'name' => 'updated_by']
            ];
        });
    }

}

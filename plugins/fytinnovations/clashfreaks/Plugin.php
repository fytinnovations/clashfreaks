<?php namespace Fytinnovations\ClashFreaks;

use System\Classes\PluginBase;
use Backend;
use RainLab\User\Models\User as FrontEndUser;
use Backend\Models\User as BackendUser;
use RainLab\Blog\Models\Post;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Fytinnovations\ClashFreaks\Components\BaseDesignList'=>"baseDesignList",
            'Fytinnovations\ClashFreaks\Components\BaseDesignInfo'=>"baseDesignInfo",
            'Fytinnovations\ClashFreaks\Components\TopHomeVillageClanList'=>"topHomeVillageClanList",
            'Fytinnovations\ClashFreaks\Components\TopHomeVillagePlayerList'=>"topHomeVillagePlayerList",
            'Fytinnovations\ClashFreaks\Components\TopBuilderVillagePlayerList'=>"topBuilderVillagePlayerList",
            'Fytinnovations\ClashFreaks\Components\TopBuilderVillageClanList'=>"topBuilderVillageClanList",
            'Fytinnovations\ClashFreaks\Components\UploadBase'=>"uploadBase",
            'Fytinnovations\ClashFreaks\Components\CreatePost'=>"createPost",
            'Fytinnovations\ClashFreaks\Components\PlayerProfile'=>"playerProfile",
            'Fytinnovations\ClashFreaks\Components\ClanProfile'=>"clanProfile",
            'Fytinnovations\ClashFreaks\Components\SearchBox'=>"searchBox",
            'Fytinnovations\ClashFreaks\Components\FavoritePlayers'=>"favoritePlayers",
            'Fytinnovations\ClashFreaks\Components\FavoriteClans'=>"favoriteClans",
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
        FrontendUser::extend(function($model) {
            $model->hasMany=[
                'ratings' => ['Fytinnovations\ClashFreaks\Models\BaseRating'],
                'favorite_clans'=>['Fytinnovations\ClashFreaks\Models\FavoriteClan'],
                'favorite_players'=>['Fytinnovations\ClashFreaks\Models\FavoritePlayer'],
            ];
        });
        BackendUser::extend(function($model) {
            $model->morphMany=[
                'basedesigns_created' => ['Fytinnovations\ClashFreaks\Models\BaseDesign', 'name' => 'created_by'],
                'basedesigns_updated' => ['Fytinnovations\ClashFreaks\Models\BaseDesign', 'name' => 'updated_by']
            ];
        });
        Post::extend(function($model){
            $model->attachOne=[
                'raw_file'=>['System\Models\File']
            ];
        });
    }

}

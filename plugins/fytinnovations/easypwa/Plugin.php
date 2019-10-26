<?php

namespace Fytinnovations\EasyPWA;

use System\Classes\PluginBase;
use System\Classes\SettingsManager;
use App;
use Illuminate\Foundation\AliasLoader;
use Fytinnovations\EasyPWA\Classes\Manifest;
/**
 * EasyPWA Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'EasyPWA',
            'description' => 'No description provided yet...',
            'author'      => 'Fytinnovations',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {

        return [
            'fytinnovations.easypwa.access_settings' => [
                'tab' => 'fytinnovations.easypwa::lang.plugin.name',
                'label' => 'fytinnovations.easypwa::lang.plugin.permissions.access_settings'
            ],
        ];
    }

    /**
     * Registers settings for this plugin.
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'definitions' => [
                'label'       => 'fytinnovations.easypwa::lang.plugin.name',
                'description' => 'fytinnovations.easypwa::lang.plugin.description',
                'icon'        => 'icon-sitemap',
                'class'         =>'Fytinnovations\EasyPWA\Models\Settings',
                'keywords'    => 'pwa progressive manifest.json',
                'category'    => SettingsManager::CATEGORY_CMS,
                'permissions' => ['fytinnovations.easypwa.access_settings'],
            ]
        ];
    }

    public function register(){
        $alias = AliasLoader::getInstance();
        $alias->alias('PWAManifest', 'Fytinnovations\EasyPWA\Facades\PWAManifest');

        App::singleton('pwaManifest', function() {
            $manifest=new  Manifest;
            $manifest->generate();
            return $manifest;
        });
    }
}

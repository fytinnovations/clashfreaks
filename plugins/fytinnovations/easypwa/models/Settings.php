<?php namespace Fytinnovations\EasyPWA\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'fytinnovations_easypwa_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    public $attachOne = [
        'icon' => 'System\Models\File'
    ];
}
<?php

namespace Fytinnovations\EasyPWA\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'fytinnovations_easypwa_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    public $attachOne = [
        'ios_icon' => 'System\Models\File',
    ];

    public $attachMany = [
        'icons' => 'System\Models\File',
    ];
}

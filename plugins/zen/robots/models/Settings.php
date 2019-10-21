<?php namespace Zen\Robots\Models;

use Config;
use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation as ValidationTrait;

class Settings extends Model
{
    use ValidationTrait;

    public $implement = [
        'System.Behaviors.SettingsModel',
    ];

    public $settingsCode = 'zen_robots_settings';
    public $settingsFields = 'fields.yaml';
    public $rules = [];
}

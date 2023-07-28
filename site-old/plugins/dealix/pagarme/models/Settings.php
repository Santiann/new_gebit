<?php namespace Dealix\Pagarme\Models;

use Model;

/**
 * Settings Model
 */
class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'pagarme_settings';

    public $settingsFields = 'fields.yaml';
}

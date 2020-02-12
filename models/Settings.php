<?php namespace EEV\Company\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'eev_company_settings';

    public $settingsFields = 'fields.yaml';
}

<?php

namespace EEV\Company;

use EEV\Company\Components\Address;
use EEV\Company\Components\Contact;
use EEV\Company\Components\Logo;
use Eev\Company\Components\OpeningHours;
use EEV\Company\Components\Socials;
use EEV\Company\Models\Settings;
use Illuminate\Support\Facades\Event;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public $require = ['EEV.Core'];

    public function registerComponents()
    {
        return [
            Contact::class => 'contact',
            Address::class => 'address',
            Socials::class => 'socials',
            OpeningHours::class => 'opening_hours',
            Logo::class => 'logo',
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label' => 'eev.company::lang.company_settings',
                'description' => '',
                'category' => 'eev.company::lang.company',
                'class' => Settings::class,
                'icon' => 'icon-globe',
                'order' => 500,
                'keywords' => 'geography place placement'
            ]
        ];
    }

    public function register()
    {
        parent::register();
    }

}
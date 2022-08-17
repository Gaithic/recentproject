<?php namespace Netgen\Register;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return ([
            'Netgen\Register\Components\Registration' => 'UserRegistration',
            'Netgen\Register\Components\UserLogin' => 'UserLoginw',
        ]);
    }

    public function registerSettings()
    {
    }
}

<?php

namespace Codeitlikemiley\VuetifiedLaravelPreset;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Console\Presets\Preset as LaravelPreset;

class Preset extends LaravelPreset
{
    public static function cleanSassDirectory()
    {
        File::cleanDirectory(resource_path('sass'));
    }

    public static function getPackagesTobeInstalled()
    {
        return [
            'inertiajs/inertia-laravel',
            'squizlabs/php_codesniffer',
            'pragmarx/version',
            'jackiedo/dotenv-editor'
        ];
    }

    public static function install()
    {
        static::updatePackages();
        static::updateMix();
        static::updateScripts();
        static::updateStyles();
        static::installPackages();
    }

    public static function installPackages()
    {
        $package1 = exec('composer show -N | grep inertiajs/inertia-laravel');

        if (!$package1) {
            exec('composer require intertiajs/inertia-laravel');
        }

        $package2 = exec('composer show -N | grep pragmarx/version');

        if (!$package2) {
            exec('composer require pragmarx/version');
        }

        $package3 = exec('composer show -N | grep jackiedo/dotenv-editor');

        if (!$package3) {
            exec('composer require jackiedo/dotenv-editor');
        }
    }

    public static function packagesToBeAdded()
    {
        return [
            'laravel-mix-tailwind' => '^0.1.0'
            // add other packages here
        ];
    }

    /**
     * @param $packages
     */
    public static function packagesTobeRemoved($packages)
    {
        return Arr::except($packages, ['popper.js', 'jquery']);
    }

    /**
     * @param $packages
     */
    public static function updatePackageArray($packages)
    {
        return array_merge(static::packagesToBeAdded(), static::packagesTobeRemoved($packages));
    }

    public static function updateScripts()
    {
        copy(__DIR__.'/stubs/app.js', resource_path('js/app.js'));
        copy(__DIR__.'/stubs/bootstrap.js', resource_path('js/bootstrap.js'));
    }

    public static function updateStyles()
    {
        File::cleanDirectory(resource_path('sass'));
        File::put(resource_path('sass/app.sass'), '');
    }

    public static function updatemix()
    {
        copy(__DIR__.'/stubs/webpack.mix.js', base_path('webpack.mix.js'));
    }
}

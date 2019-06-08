<?php

namespace Codeitlikemiley\VuetifiedLaravelPreset;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Nadar\PhpComposerReader\ComposerReader;
use Nadar\PhpComposerReader\RequireSection;
use Illuminate\Foundation\Console\Presets\Preset as LaravelPreset;

class Preset extends LaravelPreset
{
    public static function cleanSassDirectory()
    {
        File::cleanDirectory(resource_path('sass'));
    }

    public static function install()
    {
        static::updatePackages();
        static::updateMix();
        static::updateScripts();
        static::updateStyles();
        static::updateComposer();
        static::revertComposer();
        static::testRemoveComposer();
        // static::installPackages();
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

    public static function revertComposer()
    {
        $path_to_file = base_path('composer.json');

        $block_of_lines = file_get_contents($path_to_file);

        $rm_packages = ['filp/whoops', 'fzaninotto/faker', 'mockery/mockery'];

        $rm_packages_match = '(?:'.join('|', array_map(function ($word) {
            return preg_quote($word, '/');
        }, $rm_packages)).')';

        $replace_match = '/^.*'.$rm_packages_match.'.*$(?:\r\n|\n)?/m';

        $result = preg_replace($replace_match, '', $block_of_lines);

        file_put_contents($path_to_file, $result);
    }

    public static function testRemoveComposer()
    {
        $reader      = new ComposerReader(base_path('composer.json'));
        $section     = new RequireSection($reader);
        $packages    = $reader->contentSection('require', $section);
        $composer    = new Composer($reader, $section, $packages);
        $rm_packages= [
            'pragmarx/version'           => '^0.2.9',
            'jackiedo/dotenv-editor'     => '^1.0'
        ];
        $composer->removePackages($rm_packages);
        $composer->updateSection();
        $composer->save();
    }

// This should be added as a dependency of our packages

// check git init before doing this install

// thow an error and abort install if not git initA

// Review Laravel FileSystem

// get the current file content

// File::get($path)

// search and replace the file content
    // use File::put($path,$contents)

    public static function updateComposer()
    {
        $reader      = new ComposerReader(base_path('composer.json'));
        $section     = new RequireSection($reader);
        $packages    = $reader->contentSection('require', $section);
        $composer    = new Composer($reader, $section, $packages);
        $rm_packages = [
            'intertiajs/inertia-laravel' => 'dev-master',
            'pragmarx/version'           => '^0.2.9',
            'jackiedo/dotenv-editor'     => '^1.0'
        ];
        $composer->addPackages($rm_packages);
        $composer->updateSection();
        $composer->save();
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

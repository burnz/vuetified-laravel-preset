<?php

namespace Codeitlikemiley\VuetifiedLaravelPreset;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Nadar\PhpComposerReader\ComposerReader;
use Nadar\PhpComposerReader\RequireSection;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Foundation\Console\Presets\Preset as LaravelPreset;

class Preset extends LaravelPreset
{
    public static function addComposerPackages()
    {
        $reader      = new ComposerReader(base_path('composer.json'));
        $section     = new RequireSection($reader);
        $packages    = $reader->contentSection('require', $section);
        $composer    = new AddComposerPackages($reader, $section, $packages);
        $rm_packages = [
            'intertiajs/inertia-laravel' => 'dev-master',
            'pragmarx/version'           => '^0.2.9',
            'jackiedo/dotenv-editor'     => '^1.0'
        ];
        $composer->addPackages($rm_packages);
        $composer->updateSection();
        $composer->save();
        $array_keys = array_keys($rm_packages);
        $str        = implode(', ', $array_keys);
        static::consoleLog('The Following Packages are Added '.$str);
    }

    public static function addInertiaJs()
    {
        copy(__DIR_.'/stubs/Inertia/.babelrc', base_path('.babelrc'));
        static::consoleLog('Adding .babelrc file');
        copy(__DIR__.'/stubs/Inertia/app.blade.php', resource_path('views/app.blade.php'));
        static::consoleLog('Adding Default Inertial app.blade.php');
        File::makeDirectory(resource_path('js/Shared'));
        static::consoleLog('Adding Shared Directory for Inertia');
        copy(__DIR__.'/stubs/Inertia/Shared/Layout.vue', resource_path('/js/Shared/Layout.vue'));
        static::consoleLog('Adding Default Layout of Inertia');
        copy(__DIR__.'/stubs/Inertia/webpack.mix.js', base_path('webpack.mix.js'));
        static::consoleLog('Adding Default webpack.mix.js for Inertia');
        File::deleteDirectory(resource_path('js/components'));
        static::consoleLog('Components Directory Deleted.');
        File::makeDirectory(resource_path('js/Pages'));
        static::consoleLog('Created Pages Directory for Intertia');
        File::copyDirectory(__DIR.'/stubs/Inertia/Pages',resource_path('js/Pages'));
        static::consoleLog('Copying Pages Directory');
        // find a way to add kernel changes by inertia using php filesystem
    }

    public static function addPHPCS()
    {
        $installed = exec('composer show -N | grep squizlabs/php_codesniffer');

        if (!$installed) {
            exec('composer require --dev squizlabs/php_codesniffer');
        }

        copy(__DIR__.'/phpcs.xml', base_path('.phpcs.xml'));
        static::consoleLog('PHPCS Installed.');
    }

    public static function addVSCodeConfig()
    {
        File::makeDirectory(base_path('.vscode'));
        copy(__DIR_.'./stubs/.vscode/settings.json', base_path('.vscode/settings.json'));
        static::consoleLog('VSCODE Config Added.');
    }

    public static function cleanSassDirectory()
    {
        File::cleanDirectory(resource_path('sass'));
        static::consoleLog('SASS Directory Cleaned');
    }

    public static function composerInstall()
    {
        $packages = [
            'inertiajs/inertia-laravel',
            'pragmarx/version'
        ];

        foreach ($packages as $package) {
            $installed = exec('composer show -N | grep '.$package);

            if (!$installed) {
                exec('composer require '.$package);
            }
        }

        $str = implode(', ', $packages);
        static::consoleLog('The Following Packages Have Been Installed: '.$str);
    }

    /**
     * @param $message
     */
    public static function consoleLog($message)
    {
        $out = new ConsoleOutput();
        $out->writeLn($message);
    }

    public static function install()
    {
        static::addVSCodeConfig();
        static::addInertiaJs();
        static::addPHPCS();
        static::updatePackages();
        static::updateMix();
        static::updateScripts();
        static::updateStyles();

// All about composer

// static::addComposerPackages();
        // static::removeComposerPackages();
        static::composerInstall();
    }

    /**
     * @return mixed
     */
    public static function packagesToBeAdded()
    {
        $packages = [
            'laravel-mix-tailwind'                => '^0.1.0',
            'inertiajs/inertia-vue'               => 'github:inertiajs/inertia-vue',
            '@babel/plugin-syntax-dynamic-import' => '^7.2.0'
            // add other packages here
        ];
        $array_keys = array_keys($packages);
        $str        = implode(', ', $array_keys);

        static::consoleLog('Adding The Folling Packages to package.json: '.$str);
        return $packages;
    }

    /**
     * @param $packages
     */
    public static function packagesTobeRemoved($packages)
    {
        $rm_packages = ['popper.js', 'jquery'];
        $str         = implode(', ', $rm_packages);
        static::consoleLog('Removing The Following Packages from packages.json: '.$str);
        return Arr::except($packages, $rm_packages);
    }

    public static function removeComposerPackages()
    {
        $packages = [
            'inertialjs/inertia-laravel',
            'pragmarx/version'
        ];
        $array_keys = array_keys($packages);
        $str        = implode(', ', $packages);
        $composer   = new RemoveComposerPackages($packages);
        $composer->delete();
        static::consoleLog('The Following Dependencies will be removed from composer.json: '.$str);
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
        static::consoleLog('Styles Updated!');
    }

    public static function updatemix()
    {
        copy(__DIR__.'/stubs/webpack.mix.js', base_path('webpack.mix.js'));
        static::consoleLog('webpack.mix.js Has been updated!');
    }
}

<?php

namespace Codeitlikemiley\VuetifiedLaravelPreset;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Foundation\Console\Presets\Preset as LaravelPreset;

class Preset extends LaravelPreset
{
    public static function addInertiaJs()
    {
        copy(__DIR__.'/stubs/Inertia/.babelrc', base_path('.babelrc'));
        static::consoleLog('Adding .babelrc file');

        copy(__DIR__.'/stubs/Inertia/app.blade.php', resource_path('views/app.blade.php'));
        static::consoleLog('Adding Default Inertia app.blade.php');
        File::makeDirectory(resource_path('js/Shared'));
        copy(__DIR__.'/stubs/Inertia/Shared/Layout.vue', resource_path('js/Shared/Layout.vue'));
        static::consoleLog('Adding Default Layout of Inertia');

        copy(__DIR__.'/stubs/Inertia/webpack.mix.js', base_path('webpack.mix.js'));
        static::consoleLog('Adding Default webpack.mix.js for Inertia');

        File::deleteDirectory(resource_path('js/components'));
        static::consoleLog('Components Directory Deleted.');
        File::makeDirectory(resource_path('/js/Pages'));
        File::copyDirectory(__DIR__.'/stubs/Inertia/Pages', resource_path('js/Pages'));
        static::consoleLog('Copying Pages Directory');

        copy(__DIR__.'/stubs/Inertia/routes/web.php',base_path('routes/web.php'));
        static::consoleLog('Copying Example Routes Of Inertia');
        // find a way to add kernel changes by inertia using php filesystem
    }

    public static function addPHPCS()
    {
        $installed = exec('composer show -N | grep squizlabs/php_codesniffer');

        if (!$installed) {
            exec('composer require --dev squizlabs/php_codesniffer');
        }

        copy(__DIR__.'/stubs/phpcs.xml', base_path('phpcs.xml'));
        static::consoleLog('PHPCS Installed.');
    }

    public static function addVSCodeConfig()
    {
        File::copyDirectory(__DIR__.'/stubs/.vscode', base_path('.vscode'));
        static::consoleLog('VSCODE Config Added.');
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
        static::addPHPCS();
        static::addInertiaJs();
        static::updateStyles();
        static::updatePackages();
        static::composerInstall();
        static::npmInstall();
        static::consoleLog('FINISHED SETTING UP VUETIFIED. please run npm run watch or npm run dev.')
    }

    /**
     * @return mixed
     */
    public static function packagesToBeAdded()
    {
        $packages = [
            'inertiajs/inertia-vue'               => 'github:inertiajs/inertia-vue',
            '@babel/plugin-syntax-dynamic-import' => '^7.2.0',
            'vue-template-compiler' => '^2.6.10',
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

    /**
     * @param $packages
     */
    public static function updatePackageArray($packages)
    {
        return array_merge(static::packagesToBeAdded(), static::packagesTobeRemoved($packages));
    }

    public static function updateStyles()
    {
        File::deleteDirectory(resource_path('sass'));
        static::consoleLog('Sass Directory Deleted');
    }

    public static function npmInstall()
    {
        exec('npm install');
    }
}

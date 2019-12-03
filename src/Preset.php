<?php

namespace Codeitlikemiley\VuetifiedLaravelPreset;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Foundation\Console\Presets\Preset as LaravelPreset;

class Preset extends LaravelPreset
{
    public static function addBabelRC()
    {
        copy(__DIR__.'/stubs/.babelrc', base_path('.babelrc'));
        static::consoleLog('Adding .babelrc file');
    }

    public static function addBladeFile()
    {
        copy(__DIR__.'/stubs/resources/views/app.blade.php', resource_path('views/app.blade.php'));
        static::consoleLog('Adding Default Inertia app.blade.php');
    }

    public static function addGitHooks()
    {
        copy(__DIR__.'/stubs/pre-commit', base_path('pre-commit'));
        copy(__DIR__.'/stubs/post-commit', base_path('post-commit'));
        static::consoleLog('Added Git Hook');
    }

    public static function addInertiaJs()
    {
        File::makeDirectory(resource_path('js/Shared'));
        static::consoleLog('Creating Shared folder');

        File::makeDirectory(resource_path('/js/plugins'));
        static::consoleLog('Creating plugins Folder');

        File::deleteDirectory(resource_path('js/components'));
        static::consoleLog('Components Directory Deleted.');

        File::makeDirectory(resource_path('/js/Pages'));
        static::consoleLog('Creating Pages folder');

        copy(__DIR__.'/stubs/resources/js/Shared/HelloWorld.vue', resource_path('js/Shared/HelloWorld.vue'));
        static::consoleLog('Adding Hello World Shared Component');

        File::copyDirectory(__DIR__.'/stubs/resources/js/Pages', resource_path('js/Pages'));
        static::consoleLog('Adding Pages');

        copy(__DIR__.'/stubs/routes/web.php', base_path('routes/web.php'));
        static::consoleLog('Copying Example Routes Of Inertia');
        // find a way to add kernel changes by inertia using php filesystem
    }

    public static function addOrchestraBench()
    {
        $installed = exec('composer show -N | grep orchestra/testbench');

        if (!$installed) {
            exec('composer require --dev orchestra/testbench');
        }

        static::consoleLog('Added Orchestra Bench');
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

    public static function addPHPSTAN()
    {
        $installed = exec('composer show -N | grep nunomaduro/larastan');

        if (!$installed) {
            exec('composer require --dev nunomaduro/larastan');
        }

        copy(__DIR__.'/stubs/phpstan.neon.dist', base_path('phpstan.neon.dist'));
        static::consoleLog('Added PHPSTAN');
    }

    public static function addVSCodeConfig()
    {
        File::copyDirectory(__DIR__.'/stubs/.vscode', base_path('.vscode'));
        static::consoleLog('VSCODE Config Added.');
    }

    public static function addWebpackMix()
    {
        copy(__DIR__.'/stubs/webpack.mix.js', base_path('webpack.mix.js'));
        static::consoleLog('Adding Default webpack.mix.js for Inertia');
    }

    public static function composerInstall()
    {
        $packages = [
            'inertiajs/inertia-laravel',
            'tightenco/ziggy',
            'pragmarx/version',
            'reinink/remember-query-strings',
            'spatie/laravel-permission',
            'barryvdh/laravel-cors',
            'envant/fireable'
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
     * @param string $message
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
        static::addPHPSTAN();
        static::addOrchestraBench();
        static::addBabelRC();
        static::addWebpackMix();
        static::addBladeFile();
        static::addInertiaJs();
        static::updateStyles();
        static::updateScripts();
        static::updatePackages();
        static::composerInstall();
        static::updateHTTPKernel();
        static::updateConfig();
        static::npmInstall();
        static::addGitHooks();
        static::consoleLog('FINISHED SETTING UP VUETIFIED. please run npm run watch or npm run dev.');
    }

    public static function npmInstall()
    {
        exec('npm install');
    }

    /**
     * @return mixed
     */
    public static function packagesToBeAdded()
    {
        $packages = [
            'vue'                                 => '^2.6.10',
            'vuetify'                             => '^2.1.12',
            '@inertiajs/inertia'                  => '^0.1.7',
            '@inertiajs/inertia-vue'              => '^0.1.2',
            '@babel/plugin-syntax-dynamic-import' => '^7.7.4',
            '@babel/preset-env'                   => '^7.7.5',
            'vue-template-compiler'               => '^2.6.10',
            'css-loader'                          => '^3.2.1',
            'style-loader'                        => '^1.0.1',
            'stylus'                              => '^0.54.7',
            'stylus-loader'                       => '^3.0.2',
            'vuetify-loader'                      => '^1.3.0',
            'deepmerge'                           => '^4.2.2',
            'fibers'                              => '^4.0.2',
            'eslint'                              => '^6.7.2',
            'eslint-plugin-vue'                   => '^6.0.1',
            'eslint-plugin-import'                => '^2.18.2',
            '@fortawesome/fontawesome-free'       => '^5.11.2',
            'font-awesome'                        => '^4.7.0',
            '@mdi/font'                           => '^4.6.95',
            '@mdi/js'                             => '^4.6.95',
            'material-design-icons-iconfont'      => '^5.0.1',
            'roboto-fontface'                     => '^0.10.0',
            'vue-loader'                          => '^15.7.2'
            // add other packages here
        ];
        $array_keys = array_keys($packages);
        $str        = implode(', ', $array_keys);

        static::consoleLog('Adding The Following Packages to package.json: '.$str);
        return $packages;
    }

    /**
     * @param $packages
     */
    public static function packagesTobeRemoved($packages)
    {
        $rm_packages = ['popper.js', 'jquery', 'axios', 'bootstrap'];
        $str         = implode(', ', $rm_packages);
        static::consoleLog('Removing The Following Packages from packages.json: '.$str);
        return Arr::except($packages, $rm_packages);
    }

    public static function updateConfig()
    {
        copy(__DIR__.'/stubs/config/version.yml', base_path('config/version.yml'));
        static::consoleLog('Adding Version YML file');
    }

    public static function updateHTTPKernel()
    {
        File::delete(app_path('Http/Kernel.php'));
        copy(__DIR__.'/stubs/app/Http/Kernel.php', base_path('app/Http/Kernel.php'));
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
        File::delete(resource_path('js/bootstrap.js'));
        static::consoleLog('Boostrap.js Deleted');

        copy(__DIR__.'/stubs/resources/js/app.js', resource_path('js/app.js'));
        static::consoleLog('Inertia Default app.js file Added.');

        copy(__DIR__.'/stubs/.eslintrc.js', base_path('.eslintrc.js'));
        static::consoleLog('Added Eslintrc.js');

        copy(__DIR__.'/stubs/resources/js/plugins/vuetify.js', resource_path('js/plugins/vuetify.js'));
        static::consoleLog('Added Vuetify.js Plugin');
    }

    public static function updateStyles()
    {
        File::cleanDirectory(resource_path('sass'));
        File::put(resource_path('sass/app.scss'), '');
        static::consoleLog('Styles Updated!');
    }
}

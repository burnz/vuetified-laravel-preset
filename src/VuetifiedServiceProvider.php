<?php

namespace Codeitlikemiley\VuetifiedLaravelPreset;

use Illuminate\Foundation\Console\PresetCommand;
use Illuminate\Support\ServiceProvider;

class VuetifiedServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        PresetCommand::macro('vuetified', function ($command) {
            Preset::install();
            $command->info('Vuetified Laravel Preset Installed!');
        });
    }
}

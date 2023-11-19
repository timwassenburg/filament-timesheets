<?php

namespace TimWassenburg\FilamentTimesheets;

use Illuminate\Support\ServiceProvider;

class FilamentTimesheetsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'filament-timesheet');

        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/filament-timesheet'),
        ], 'filament-timesheet');
    }
}

<?php

namespace TimWassenburg\FilamentTimesheets;

use Filament\Contracts\Plugin;
use Filament\Panel;
use TimWassenburg\FilamentTimesheets\Resources\ClientResource;
use TimWassenburg\FilamentTimesheets\Resources\ProjectResource;
use TimWassenburg\FilamentTimesheets\Resources\TimesheetResource;
use TimWassenburg\FilamentTimesheets\Widgets\TimesheetOverview;

class FilamentTimesheetsPlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-timesheet';
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                ClientResource::class,
                ProjectResource::class,
                TimesheetResource::class,
            ])
            ->widgets([
                TimesheetOverview::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}

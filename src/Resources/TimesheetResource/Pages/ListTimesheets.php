<?php

namespace TimWassenburg\FilamentTimesheets\Resources\TimesheetResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use TimWassenburg\FilamentTimesheets\Resources\TimesheetResource;
use TimWassenburg\FilamentTimesheets\Widgets\TimesheetOverview;

class ListTimesheets extends ListRecords
{
    protected static string $resource = TimesheetResource::class;

    public static function getWidgets(): array
    {
        return [
            TimesheetOverview::class,
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TimesheetOverview::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'this_week' => Tab::make(__('filament-timesheet::timesheet.this_week'))->query(fn ($query) => $query->thisWeek()),
            'last_week' => Tab::make(__('filament-timesheet::timesheet.last_week'))->query(fn ($query) => $query->lastWeek()),
            'last_month' => Tab::make(__('filament-timesheet::timesheet.last_month'))->query(fn ($query) => $query->lastMonth()),
            'last_quarter' => Tab::make(__('filament-timesheet::timesheet.last_quarter'))->query(fn ($query) => $query->lastQuarter()),
            'this_year' => Tab::make(__('filament-timesheet::timesheet.this_year'))->query(fn ($query) => $query->thisYear()),
            'all' => Tab::make(__('filament-timesheet::timesheet.all')),
        ];
    }
}

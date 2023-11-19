<?php

namespace TimWassenburg\FilamentTimesheets\Resources\TimesheetResource\Pages;

use Carbon\Carbon;
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
            'this_week' => Tab::make(__('filament-timesheet::timesheet.this_week'))->query(fn ($query) => $query->whereBetween('date', [Carbon::now()->startOfWeek()->toDateString(), Carbon::now()->endOfWeek()->toDateString()])),
            'last_week' => Tab::make(__('filament-timesheet::timesheet.last_week'))->query(fn ($query) => $query->whereBetween('date', [Carbon::now()->subWeek()->startOfWeek()->toDateString(), Carbon::now()->subWeek()->endOfWeek()->toDateString()])),
            'last_month' => Tab::make(__('filament-timesheet::timesheet.last_month'))->query(fn ($query) => $query->whereBetween('date', [Carbon::now()->subMonth()->startOfMonth()->toDateString(), Carbon::now()->subMonth()->endOfMonth()->toDateString()])),
            'last_quarter' => Tab::make(__('filament-timesheet::timesheet.last_quarter'))->query(fn ($query) => $query->whereBetween('date', [Carbon::now()->subQuarter()->startOfQuarter()->toDateString(), Carbon::now()->subQuarter()->endOfQuarter()->toDateString()])),
            'this_year' => Tab::make(__('filament-timesheet::timesheet.this_year'))->query(fn ($query) => $query->whereBetween('date', [Carbon::now()->startOfYear()->toDateString(), Carbon::now()->endOfYear()->toDateString()])),
            'all' => Tab::make(__('filament-timesheet::timesheet.all')),
        ];
    }
}

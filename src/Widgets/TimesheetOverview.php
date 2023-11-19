<?php

namespace TimWassenburg\FilamentTimesheets\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;
use TimWassenburg\FilamentTimesheets\Models\Timesheet;
use TimWassenburg\FilamentTimesheets\Services\TimesheetService;

class TimesheetOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $timesheetsThisWeek = Timesheet::query()->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('hours');
        $timesheetsThisMonth = Timesheet::query()->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->sum('hours');
        $timesheetsThisQuater = Timesheet::query()->whereBetween('date', [Carbon::now()->startOfQuarter(), Carbon::now()->endOfQuarter()])->sum('hours');

        return [
            Stat::make(__('filament-timesheet::timesheet.hours_this_week'), (new TimesheetService)->decimalToTime($timesheetsThisWeek)),
            Stat::make(__('filament-timesheet::timesheet.hours_this_month'), (new TimesheetService)->decimalToTime($timesheetsThisMonth)),
            Stat::make(__('filament-timesheet::timesheet.hours_this_quarter'), (new TimesheetService)->decimalToTime($timesheetsThisQuater)),
        ];
    }
}

<?php

namespace TimWassenburg\FilamentTimesheets\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use TimWassenburg\FilamentTimesheets\Services\TimesheetService;

class TimesheetOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $timesheetsThisWeek = Auth::user()->timesheets()->thisWeek()->sum('hours');
        $timesheetsThisMonth = Auth::user()->timesheets()->thisMonth()->sum('hours');
        $timesheetsThisQuater = Auth::user()->timesheets()->thisQuarter()->sum('hours');

        return [
            Stat::make(__('filament-timesheet::timesheet.hours_this_week'), (new TimesheetService)->decimalToTime($timesheetsThisWeek)),
            Stat::make(__('filament-timesheet::timesheet.hours_this_month'), (new TimesheetService)->decimalToTime($timesheetsThisMonth)),
            Stat::make(__('filament-timesheet::timesheet.hours_this_quarter'), (new TimesheetService)->decimalToTime($timesheetsThisQuater)),
        ];
    }
}

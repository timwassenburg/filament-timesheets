<?php

namespace TimWassenburg\FilamentTimesheets\Services;

class TimesheetService
{
    public function decimalToTime($decimal): array|string
    {
        $hours = intval($decimal);
        $minutes = round(60 * ($decimal - $hours));

        return sprintf('%d:%02d', $hours, $minutes);
    }
}

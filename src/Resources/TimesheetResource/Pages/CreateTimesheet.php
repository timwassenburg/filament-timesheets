<?php

namespace TimWassenburg\FilamentTimesheets\Resources\TimesheetResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use TimWassenburg\FilamentTimesheets\Resources\TimesheetResource;

class CreateTimesheet extends CreateRecord
{
    protected static string $resource = TimesheetResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

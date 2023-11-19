<?php

namespace TimWassenburg\FilamentTimesheets\Resources\TimesheetResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use TimWassenburg\FilamentTimesheets\Resources\TimesheetResource;

class EditTimesheet extends EditRecord
{
    protected static string $resource = TimesheetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

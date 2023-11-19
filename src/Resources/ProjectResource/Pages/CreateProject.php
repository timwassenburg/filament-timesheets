<?php

namespace TimWassenburg\FilamentTimesheets\Resources\ProjectResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use TimWassenburg\FilamentTimesheets\Resources\ProjectResource;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

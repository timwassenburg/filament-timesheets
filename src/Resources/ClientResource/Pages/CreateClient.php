<?php

namespace TimWassenburg\FilamentTimesheets\Resources\ClientResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use TimWassenburg\FilamentTimesheets\Resources\ClientResource;

class CreateClient extends CreateRecord
{
    protected static string $resource = ClientResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

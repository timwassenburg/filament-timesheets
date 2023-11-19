<?php

namespace TimWassenburg\FilamentTimesheets\Resources\ClientResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use TimWassenburg\FilamentTimesheets\Resources\ClientResource;

class EditClient extends EditRecord
{
    protected static string $resource = ClientResource::class;

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

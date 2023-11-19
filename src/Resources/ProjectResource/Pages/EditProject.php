<?php

namespace TimWassenburg\FilamentTimesheets\Resources\ProjectResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use TimWassenburg\FilamentTimesheets\Resources\ProjectResource;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

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

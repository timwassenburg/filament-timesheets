<?php

namespace TimWassenburg\FilamentTimesheets\Resources\ClientResource\Pages;

use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use TimWassenburg\FilamentTimesheets\Models\Client;
use TimWassenburg\FilamentTimesheets\Resources\ClientResource;

class ViewClient extends ViewRecord
{
    protected static string $resource = ClientResource::class;

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name'),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return Client::query();
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getTitle(): string
    {
        return '';
    }
}

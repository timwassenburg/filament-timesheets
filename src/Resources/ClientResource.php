<?php

namespace TimWassenburg\FilamentTimesheets\Resources;

use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use TimWassenburg\FilamentTimesheets\Models\Client;
use TimWassenburg\FilamentTimesheets\Resources\ClientResource\Pages;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('filament-timesheet::client.general_information'))
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('filament-timesheet::client.name'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label(__('filament-timesheet::client.email'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('address')
                            ->label(__('filament-timesheet::client.address'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('city')
                            ->label(__('filament-timesheet::client.city'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('zipcode')
                            ->label(__('filament-timesheet::client.zipcode'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('country')
                            ->label(__('filament-timesheet::client.country'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label(__('filament-timesheet::client.phone'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label(__('filament-timesheet::client.email'))
                            ->maxLength(255),
                    ])->columns(2),

                Section::make(__('filament-timesheet::client.registration_details'))
                    ->schema([
                        Forms\Components\TextInput::make('iban')
                            ->label(__('filament-timesheet::client.iban'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('kvk_number')
                            ->label(__('filament-timesheet::client.kvk_number'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('vat_number')
                            ->label(__('filament-timesheet::client.vat_number'))
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament-timesheet::client.name'))
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'view' => Pages\ViewClient::route('/{record}/view'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return trans('filament-timesheet::client.clients');
    }

    public static function getPluralModelLabel(): string
    {
        return trans('filament-timesheet::client.clients');
    }

    public static function getModelLabel(): string
    {
        return trans('filament-timesheet::client.client');
    }

    public static function getNavigationGroup(): ?string
    {
        return trans('filament-timesheet::timesheet.timesheets');
    }
}

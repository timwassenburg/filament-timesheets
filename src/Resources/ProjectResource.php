<?php

namespace TimWassenburg\FilamentTimesheets\Resources;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use TimWassenburg\FilamentTimesheets\Models\Client;
use TimWassenburg\FilamentTimesheets\Models\Project;
use TimWassenburg\FilamentTimesheets\Resources\ProjectResource\Pages;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('filament-timesheet::project.name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('hourly_rate')
                    ->label(__('filament-timesheet::project.hourly_rate'))
                    ->numeric()
                    ->required(),
                Select::make('client_id')
                    ->required()
                    ->relationship('client', 'name')
                    ->options(Client::all()->pluck('name', 'id'))
                    ->label(__('filament-timesheet::project.client'))
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label(__('filament-timesheet::project.name'))
                            ->required()
                            ->maxLength(255),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament-timesheet::project.name'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('client.name')
                    ->label(__('filament-timesheet::project.client')),
            ])
            ->groups([
                Group::make('client.name')
                    ->label(__('filament-timesheet::project.client')),
            ])
            ->defaultGroup('client.name')
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return trans('filament-timesheet::project.projects');
    }

    public static function getPluralModelLabel(): string
    {
        return trans('filament-timesheet::project.projects');
    }

    public static function getModelLabel(): string
    {
        return trans('filament-timesheet::project.project');
    }

    public static function getNavigationGroup(): ?string
    {
        return trans('filament-timesheet::timesheet.timesheets');
    }
}

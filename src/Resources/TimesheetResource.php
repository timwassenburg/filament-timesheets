<?php

namespace TimWassenburg\FilamentTimesheets\Resources;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use TimWassenburg\FilamentTimesheets\Models\Client;
use TimWassenburg\FilamentTimesheets\Models\Project;
use TimWassenburg\FilamentTimesheets\Models\Timesheet;
use TimWassenburg\FilamentTimesheets\Resources\TimesheetResource\Pages;
use TimWassenburg\FilamentTimesheets\Services\TimesheetService;

class TimesheetResource extends Resource
{
    protected static ?string $model = Timesheet::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('project_id')
                    ->relationship('project', 'name')
                    ->required()
                    ->options(fn () => Project::with('client')->get()->groupBy('client.name')->map(fn ($projects, $client) => $projects->pluck('name', 'id')->toArray())->toArray())
                    ->label(__('filament-timesheet::timesheet.project'))
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label(__('filament-timesheet::project.name'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('hourly_rate')
                            ->label(__('filament-timesheet::project.hourly_rate'))
                            ->required()
                            ->integer(),
                        Select::make('client_id')
                            ->label(__('filament-timesheet::project.client'))
                            ->options(Client::all()->pluck('name', 'id')),
                    ]),
                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->label(__('filament-timesheet::timesheet.date'))
                    ->default(now()->format('Y-m-d'))->format('Y-m-d'),
                Forms\Components\TextInput::make('hours')
                    ->required()
                    ->label(__('filament-timesheet::timesheet.hours'))
                    ->placeholder(0),
                Forms\Components\TextInput::make('description')
                    ->label(__('filament-timesheet::timesheet.description'))
                    ->maxLength(60),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->label(__('filament-timesheet::timesheet.date'))
                    ->dateTime('l d F Y')
                    ->description(fn (Timesheet $record): ?string => $record->description),
                Tables\Columns\TextColumn::make('hours')
                    ->summarize(Sum::make())
                    ->formatStateUsing(fn (Timesheet $record): string => (new TimesheetService())->decimalToTime($record->hours))
                    ->label(__('filament-timesheet::timesheet.hours')),
                Tables\Columns\TextColumn::make('project.name')
                    ->label(__('filament-timesheet::timesheet.project'))
                    ->url(fn (Timesheet $record): ?string => ProjectResource::getUrl('edit', ['record' => $record->project])),
                Tables\Columns\TextColumn::make('project.client.name')
                    ->label(__('filament-timesheet::timesheet.client'))
                    ->url(fn (Timesheet $record): ?string => ClientResource::getUrl('edit', ['record' => $record->project->client])),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Filter::make('date')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')->label(__('filament-timesheet::timesheet.created_from')),
                        Forms\Components\DatePicker::make('created_until')->label(__('filament-timesheet::timesheet.created_until')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                            );
                    }),
                SelectFilter::make('project_id')
                    ->options(Project::all()->pluck('name', 'id'))
                    ->label(__('filament-timesheet::timesheet.project')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make(),
            ]);
    }

    protected function getTableBulkActions(): array
    {
        return [
            //
        ];
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
            'index' => Pages\ListTimesheets::route('/'),
            'create' => Pages\CreateTimesheet::route('/create'),
            'edit' => Pages\EditTimesheet::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return trans('filament-timesheet::timesheet.timesheets');
    }

    public static function getPluralModelLabel(): string
    {
        return trans('filament-timesheet::timesheet.timesheets');
    }

    public static function getModelLabel(): string
    {
        return trans('filament-timesheet::timesheet.timesheet');
    }

    public static function getNavigationGroup(): ?string
    {
        return trans('filament-timesheet::timesheet.timesheets');
    }
}

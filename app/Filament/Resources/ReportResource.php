<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Filament\Resources\ReportResource\RelationManagers;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;


class ReportResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'clarity-export-outline-badged';
    protected static ?string $navigationLabel = 'Report';

    protected static ?string $navigationGroup = 'Ticket Report';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('department_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('ticket_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\TextInput::make('open_time')
                    ->required(),
                Forms\Components\TextInput::make('close_time')
                    ->required(),
                Forms\Components\TextInput::make('priority_level')
                    ->required(),
                Forms\Components\TextInput::make('category')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('type_device')
                    ->required(),
                Forms\Components\TextInput::make('operation_system')
                    ->required(),
                Forms\Components\TextInput::make('software_or_application')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('error_message')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('step_taken')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('ticket_status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('department_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ticket_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('open_time'),
                Tables\Columns\TextColumn::make('close_time'),
                Tables\Columns\TextColumn::make('priority_level'),
                Tables\Columns\TextColumn::make('category'),
                Tables\Columns\TextColumn::make('type_device'),
                Tables\Columns\TextColumn::make('operation_system'),
                Tables\Columns\TextColumn::make('software_or_application')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ticket_status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        Grid::make([
                            'default' => 1,
                            'sm' => 1,
                            'md' => 2,
                            'lg' => 2,
                            'xl' => 2,
                            '2xl' => 2,
                        ])
                        ->schema([
                            DatePicker::make('created_from')->label('From'),
                            DatePicker::make('created_until')->label('To')
                        ])
                        
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['created_from'], fn($q) => $q->whereDate('created_at', '>=', $data['created_from']))
                            ->when($data['created_until'], fn($q) => $q->whereDate('created_at', '<=', $data['created_until']));
                    }),
                    SelectFilter::make('status')
                        ->options([
                            'on_progress' => 'On Progress',
                            'solved' => 'Solved',
                            'callback' => 'Callback',
                            'monitored' => 'Monitored',
                            'other' => 'Other',
                        ]),
                    SelectFilter::make('operation_system')
                        ->options([
                            'windows' => 'Windows',
                            'macos' => 'MacOS',
                            'linux' => 'Linux',
                            'other' => 'Other',
                        ]),
                    SelectFilter::make('type_device')
                        ->options([
                            'desktop' => 'Desktop',
                            'laptop' => 'Laptop',
                            'printer' => 'Printer',
                            'other' => 'Other',
                        ]),
                    SelectFilter::make('priority_level')
                        ->options([
                            'low' => 'Low',
                            'medium' => 'Medium',
                            'high' => 'High',
                        ])
            ], layout: FiltersLayout::AboveContent)
            ->filtersFormColumns(5)
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageReports::route('/'),
        ];
    }
}

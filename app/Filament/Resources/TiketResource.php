<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TiketResource\Pages;
use App\Filament\Resources\TiketResource\RelationManagers;
use App\Models\Tiket;
use Filament\Forms;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PHPUnit\Framework\Attributes\Ticket;

class TiketResource extends Resource
{
    protected static ?string $model = Tiket::class;
    protected static ?string $navigationLabel = 'Ticket Supports';
    protected static ?string $navigationIcon = 'heroicon-s-ticket';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'nip') // Tetap gunakan 'nip' sebagai value field
                    ->getOptionLabelFromRecordUsing(fn($record) => "{$record->nip} - {$record->name}")
                    ->searchable(['name', 'email'])
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('ticket_number')
                    ->required()
                    ->unique()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\TimePicker::make('open_time')
                    ->required(),
                Forms\Components\TimePicker::make('close_time')
                    ->required(),
                Forms\Components\ToggleButtons::make('priority_level')
                    ->options([
                        'low' => 'Low',
                        'medium' => 'Medium',
                        'high' => 'High',
                    ])
                    ->grouped()
                    ->required(),
                Forms\Components\ToggleButtons::make('category')
                    ->options([
                        'software' => 'Software',
                        'hardware' => 'Hardware',
                        'network' => 'Network',
                        'other' => 'Other',
                    ])
                    ->grouped()
                    ->required(),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\ToggleButtons::make('type_device')
                    ->options([
                        'desktop' => 'Desktop',
                        'laptop' => 'Laptop',
                        'printer' => 'Prnter',
                        'other' => 'Other',
                    ])
                    ->required()
                    ->grouped(),
                Forms\Components\ToggleButtons::make('operation_system')
                    ->required()
                    ->options([
                        'windows' => 'Windows',
                        'macos' => 'MacOS',
                        'linux' => 'linux',
                        'other' => 'Other',
                    ])
                    ->grouped(),
                Forms\Components\TextInput::make('software_or_application')->required()->maxLength(255),
                Forms\Components\Textarea::make('error_message')->required()->columnSpanFull(),
                Forms\Components\Textarea::make('step_taken')->columnSpanFull(),
                Forms\Components\ToggleButtons::make('status_tiket')
                    ->required()
                    ->options([
                        'on_progress' => 'On Progress',
                        'solved' => 'Solved',
                        'callback' => 'Callback',
                        'monitored' => 'Monitored',
                        'other' => 'Other',
                    ])
                    ->grouped(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('priority_level')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'low' => 'gray',
                        'medium' => 'warning',
                        'high' => 'success',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('open_time')
                    ->dateTime('H:i')
                    ->searchable(),
                Tables\Columns\TextColumn::make('close_time')
                    ->dateTime('H:i')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type_device')
                    ->searchable(),
                Tables\Columns\TextColumn::make('operation_system')
                    ->searchable(),
                Tables\Columns\TextColumn::make('software_or_application')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_tiket')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'solved' => 'gray',
                        'callback' => 'warning',
                        'monitored' => 'success',
                        'other' => 'danger',
                    })
                    ->searchable(),
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
                //
            ])
            ->actions([
                Tables\Actions\Action::make('set_status')
                    ->label('Update Status')
                    ->form([
                        ToggleButtons::make('status_tiket')
                            ->label('Ticket Status')
                            ->options([
                                'solved' => 'Solved',
                                'callback' => 'Callback',
                                'monitored' => 'Monitored',
                                'other' => 'Other',
                            ])
                            ->grouped()
                            ->required(),
                    ])
                    ->action(function (array $data, Tiket $record): void {
                        $record->update([
                            'status_tiket' => $data['status_tiket'],
                        ]);
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Confirm Status Update')
                    ->modalSubheading('Are you sure you want to update the ticket status?'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ManageTikets::route('/'),
        ];
    }
}

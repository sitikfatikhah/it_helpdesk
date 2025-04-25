<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\RelationManagers;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\DB; // ✅ Tambahkan ini
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;
    protected static ?string $navigationLabel = 'Ticket Supports';
    protected static ?string $navigationIcon = 'heroicon-s-ticket';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'nip')
                ->getOptionLabelFromRecordUsing(fn($record) => "{$record->nip} - {$record->name}")
                ->searchable(['name', 'email'])
                ->preload()
                ->required(),
            Forms\Components\Select::make('department_id')
                ->relationship('department', 'nama_department')
                ->searchable()
                ->preload()
                ->required(),
            Forms\Components\TextInput::make('ticket_number')
                ->label('Ticket Number')
                ->default(function () {
                $yearSuffix = now()->format('y'); // Ambil 2 digit belakang tahun, misalnya: '25'
        
                $countThisYear = DB::table('Ticket')
                    ->whereYear('created_at', now()->year)
                    ->count();
        
                $sequence = str_pad($countThisYear + 1, 3, '0', STR_PAD_LEFT);
        
                return 'TC-' . $yearSuffix . $sequence;
            })
                ->disabled()
                ->dehydrated(false)
                ->required()
                ->maxLength(255),
            Forms\Components\DatePicker::make('date')->required(),
            Forms\Components\TimePicker::make('open_time')->required(),
            Forms\Components\ToggleButtons::make('priority_level')
                ->options([
                    'low' => 'Low',
                    'medium' => 'Medium',
                    'high' => 'High',
                ])
                ->grouped()
                ->required(),
            Forms\Components\TimePicker::make('close_time')->required(),

            

            Forms\Components\ToggleButtons::make('category')
                ->options([
                    'software' => 'Software',
                    'hardware' => 'Hardware',
                    'network' => 'Network',
                    'other' => 'Other',
                ])
                ->grouped()
                ->required(),
                Forms\Components\Textarea::make('description')
                ->required()
                ->columnSpanFull(),
                Forms\Components\ToggleButtons::make('type_device')
                ->label('Device Type')
                ->options([
                    'desktop' => 'Desktop',
                    'laptop' => 'Laptop',
                    'printer' => 'Printer', // typo fixed
                    'other' => 'Other',
                ])
                ->required()
                ->grouped(),
            
            Forms\Components\ToggleButtons::make('operation_system')
                ->required()
                ->options([
                    'windows' => 'Windows',
                    'macos' => 'MacOS',
                    'linux' => 'Linux',
                    'other' => 'Other',
                ])
                ->grouped(),
           
            Forms\Components\TextInput::make('software_or_application')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('error_message')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('step_taken')
                ->columnSpanFull(),

            Forms\Components\ToggleButtons::make('ticket_status')
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
                Tables\Columns\TextColumn::make('ticket_status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'on_progress' => 'info',
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
                        ToggleButtons::make('ticket_status')
                            ->label('Ticket Status')
                            ->options([
                                'on_progress' => 'On progress',
                                'solved' => 'Solved',
                                'callback' => 'Callback',
                                'monitored' => 'Monitored',
                                'other' => 'Other',
                            ])
                            ->grouped()
                            ->required(),
                    ])
                    ->action(function (array $data, Ticket $record): void {
                        $record->update([
                            'ticket_status' => $data['ticket'],
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
            'index' => Pages\ManageTicket::route('/'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
    return static::getModel()::count();
}

public static function getNavigationBadgeColor(): ?string
{
    return static::getModel()::count() > 10 ? 'warning' : 'primary';
}


}
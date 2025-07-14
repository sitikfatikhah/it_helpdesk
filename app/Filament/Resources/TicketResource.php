<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Department;
use App\Filament\Imports\TicketImporter;
use App\Filament\Exports\TicketExporter;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationGroup = 'Master Ticket';

    public static function form(Form $form): Form
    {
        return $form->schema([
           Forms\Components\Select::make('user_id')
                ->label('User')
                ->default(Auth::id())
                ->relationship('user', 'name')
                ->reactive()
                ->afterStateUpdated(fn ($state, callable $set) =>
                    $set('department_id', \App\Models\User::find($state)?->department_id)
                )
                ->disabled(fn () => !auth()->user()->hasRole('superadmin')) // ❌ selain superadmin: tidak bisa ubah
                ->dehydrated(true)
                ->required(),

            Forms\Components\Select::make('department_id')
                ->default(Auth::user()->department_id)
                ->label('Department')
                ->options(fn () => Department::all()->pluck('name', 'id'))
                ->disabled()
                ->dehydrated(true)
                ->required(),

            Forms\Components\TextInput::make('ticket_number')
                ->label('Ticket Number')
                ->default(function () {
                    $yearSuffix = now()->format('y');
                    $countThisYear = Ticket::whereYear('created_at', now()->year)->count();
                    return 'TC-' . $yearSuffix . str_pad($countThisYear + 1, 3, '0', STR_PAD_LEFT);
                })
                ->disabled()
                ->dehydrated(false)
                ->required(),

            Forms\Components\DatePicker::make('date')
                ->default(today())
                ->required(),

            Forms\Components\TimePicker::make('open_time')
                ->default(now()->format('H:i'))
                ->reactive()
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

            Forms\Components\ToggleButtons::make('type_device')
                ->label('Device Type')
                ->options([
                    'desktop' => 'Desktop',
                    'laptop' => 'Laptop',
                    'printer' => 'Printer',
                    'other' => 'Other',
                ])
                ->grouped()
                ->required(),

            Forms\Components\ToggleButtons::make('operation_system')
                ->options([
                    'windows' => 'Windows',
                    'macos' => 'MacOS',
                    'linux' => 'Linux',
                    'other' => 'Other',
                ])
                ->grouped()
                ->required(),

            Forms\Components\TextInput::make('software_or_application')
                ->required(),

            Forms\Components\TextInput::make('error_message')
                ->required(),

            Forms\Components\Textarea::make('description')
                ->columnSpanFull()
                ->required(),

            Forms\Components\Textarea::make('step_taken')
                ->columnSpanFull(),

            Forms\Components\ToggleButtons::make('priority_level')
                ->options([
                    'low' => 'Low',
                    'medium' => 'Medium',
                    'high' => 'High',
                ])
                ->default('low')
                ->grouped()
                ->required()
                ->disabled(fn () => !Auth::user()?->hasRole('superadmin')),

            Forms\Components\Select::make('ticket_status')
                ->label('Status')
                ->options([
                    'on_progress' => 'On Progress',
                    'solved' => 'Solved',
                    'callback' => 'Callback',
                    'monitored' => 'Monitored',
                    'other' => 'Other',
                ])
                ->default('on_progress')
                ->disabled(fn () => !Auth::user()?->hasRole('superadmin'))
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('User'),
                Tables\Columns\TextColumn::make('ticket_number')->searchable(),
                Tables\Columns\TextColumn::make('date')->date()->sortable(),
                Tables\Columns\TextColumn::make('open_time'),
                Tables\Columns\TextColumn::make('category'),
                Tables\Columns\TextColumn::make('type_device'),
                Tables\Columns\TextColumn::make('operation_system'),
                Tables\Columns\TextColumn::make('software_or_application')->searchable(),
                Tables\Columns\TextColumn::make('priority_level'),
                Tables\Columns\TextColumn::make('ticket_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'other' => 'primary',
                        'on_progress' => 'info',
                        'solved' => 'success',
                        'monitored' => 'warning',
                        'callback' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                Action::make('updateStatus')
                    ->label('Update Status')
                    ->form([
                        Select::make('ticket_status')
                            ->label('Status')
                            ->options([
                                'on_progress' => 'On Progress',
                                'solved' => 'Solved',
                                'callback' => 'Callback',
                                'monitored' => 'Monitored',
                                'other' => 'Other',
                            ])
                            ->required(),
                        RichEditor::make('content')->label('Note'),
                    ])
                    ->modalHeading('Update Ticket Status')
                    ->icon('heroicon-m-arrow-path'),

                Tables\Actions\EditAction::make()->label('Edit')->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Tables\Actions\ImportAction::make()
                    ->importer(TicketImporter::class)
                    ->csvDelimiter(';'),

                Tables\Actions\ExportAction::make()
                    ->exporter(TicketExporter::class)
                    ->columnMapping(false)
                    ->csvDelimiter(';'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTickets::route('/'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}

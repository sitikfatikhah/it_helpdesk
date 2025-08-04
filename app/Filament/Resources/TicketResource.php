<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Department;
use App\Filament\Imports\TicketImporter;
use App\Filament\Exports\TicketExporter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;


class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationGroup = 'Master Ticket';

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
        ];
    }

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
                ->options(fn () => Department::all()>pluck('name')->toArray())
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
                ->displayFormat('H:i')
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
                ->visible(fn () => auth()->user()->hasRole('superadmin'))
                ->grouped()
                ->nullable(),

            Forms\Components\ToggleButtons::make('operation_system')
                ->options([
                    'windows' => 'Windows',
                    'macos' => 'MacOS',
                    'linux' => 'Linux',
                    'other' => 'Other',
                ])
                ->visible(fn () => auth()->user()->hasRole('superadmin'))
                ->grouped()
                ->nullable(),

            Forms\Components\TextInput::make('software_or_application')
                ->visible(fn () => auth()->user()->hasRole('superadmin'))
                ->default('-')
                ->dehydrated(true),

            Forms\Components\TextInput::make('error_message')
                ->visible(fn () => auth()->user()->hasRole('superadmin'))
                ->nullable(),

            Forms\Components\Textarea::make('description')
                ->columnSpanFull()
                ->required(),

            Forms\Components\Textarea::make('step_taken')
                ->visible(fn () => auth()->user()->hasRole('superadmin'))
                ->columnSpanFull(),

            Forms\Components\ToggleButtons::make('priority_level')
                ->options([
                    'low' => 'Low',
                    'medium' => 'Medium',
                    'high' => 'High',
                ])
                ->default('low')
                ->grouped()
                ->nullable()
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
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('User'),
                Tables\Columns\TextColumn::make('ticket_number')->searchable(),
                Tables\Columns\TextColumn::make('date')->date()->sortable(),
                Tables\Columns\TextColumn::make('department.name')->label('Department'),
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
            ->filters(
                [
                    SelectFilter::make('ticket_status')
                        ->label('Ticket Status')
                        ->multiple()
                        ->options([
                            'on_progress' => 'On Progress',
                            'solved' => 'Solved',
                            'callback' => 'Callback',
                            'monitored' => 'Monitored',
                            'other' => 'Other',
                        ]),

                    SelectFilter::make('user_id')
                        ->label('User')
                        ->relationship('user', 'name', fn ($query) => $query->orderBy('name'))
                        ->searchable()
                        ->preload(),

                    SelectFilter::make('category')
                        ->options([
                            'software' => 'Software',
                            'hardware' => 'Hardware',
                            'network' => 'Network',
                            'other' => 'Other',
                        ]),
                    SelectFilter::make('type_device')
                        ->label('Device Type')
                        ->options([
                            'desktop' => 'Desktop',
                            'laptop' => 'Laptop',
                            'printer' => 'Printer',
                            'other' => 'Other',
                        ])
                ],
                layout: FiltersLayout::AboveContent
            )

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
                    ->icon('heroicon-m-arrow-path')
                    ->visible(fn () => auth()->user()->hasRole('superadmin')),

                Tables\Actions\EditAction::make()->label('Edit')->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                ImportAction::make()
                    ->importer(TicketImporter::class)
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

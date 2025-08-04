<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use App\Models\Company;
use App\Models\Department;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Imports\UserImporter;
use Filament\Tables\Actions\ImportAction;



class UserResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'clarity-users-solid-badged';

    protected static ?string $navigationGroup = 'Master Karyawan';

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
        return $form
            ->schema([
                Forms\Components\Select::make('company_id')
                    ->relationship('company', 'company_id')
                    ->getOptionLabelFromRecordUsing(fn($record) => "{$record->company}")
                    // ->multiple()
                    ->label('Company')
                    ->preload()
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('nip')
                    ->required()
                    ->maxLength(255)
                    ->unique(table: User::class, column: 'nip', ignoreRecord: true),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                // Forms\Components\Select::make('department')
                //     ->relationship('department', 'name')
                //     // ->getOptionLabelFromRecordUsing(fn($record) => "{$record->id} - {$record->name}")
                //     // ->multiple()
                //     ->preload()
                //     ->searchable()
                //     ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        ])
                        ->default('Active')
                        ->required(),
                        // Forms\Components\DateTimePicker::make('email_verified_at'),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required()
                            ->maxLength(255),

                // Role dengan Laravel Shield (Spatie)
                Forms\Components\Select::make('role')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->label('Roles'),

                // Using CheckboxList Component
                // Forms\Components\CheckboxList::make('roles')
                //     ->relationship('roles', 'name')
                //     ->searchable(),
             ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company.company')
                    ->label('Company')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nip')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('department.name')
                    ->label('Department')
                    ->searchable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Roles')
                    ->badge()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match (strtolower($state)) {
                        'active' => 'primary',
                        'inactive' => 'gray',
                        default => 'secondary' // ✅ mencegah UnhandledMatchError
                    })
                    ->searchable(),
                // Tables\Columns\TextColumn::make('email_verified_at')
                //     ->dateTime()
                //     ->sortable(),
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
                Action::make('updateStatus')
                ->label('Update Status')
                ->form([
                    Select::make('status')
                        ->label('Status')
                        ->options([
                            'active' => 'Active',
                            'inactive' => 'Inactive'
                        ])
                        ->required(),
                    RichEditor::make('content'),
                        ])
                            ->action(function (array $data, User $record): void {
                                $record->status = $data['status'];
                                $record->save();
                            })
                            ->modalHeading('Update User Status')
                            ->icon('heroicon-m-arrow-path'),

                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
            ImportAction::make()
                ->importer(UserImporter::class)
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUsers::route('/'),
        ];
    }


}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentResource\Pages;
use App\Filament\Resources\DepartmentResource\RelationManagers;
use App\Models\Department;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;

class DepartmentResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Department::class;

    protected static ?string $navigationIcon = 'heroicon-s-squares-plus';

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
            Forms\Components\TextInput::make('name')
                ->label('Departement')
                ->required()
                ->maxLength(255),

            Forms\Components\Select::make('user_id')
                ->label('Manager')
                ->relationship('user', 'user_id')
                ->getOptionLabelFromRecordUsing(fn($record) => "{$record->nip} - {$record->name}")
                ->searchable()
                ->preload()
                ->nullable(),
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Manager')
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
            'index' => Pages\ManageDepartments::route('/'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
    return static::getModel()::count();
    }
}

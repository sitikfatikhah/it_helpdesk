<?php

namespace App\Filament\Imports;

use App\Models\Ticket;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Filament\Forms\Components\Checkbox;

class TicketImporter extends Importer
{
    protected static ?string $model = Ticket::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('user_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer'])
                ->label('User id'),
            ImportColumn::make('department_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer'])
                ->label('Department id'),
            ImportColumn::make('ticket_number')
                ->requiredMapping()
                ->rules(['required', 'max:255'])
                ->label('Ticket number'),
            ImportColumn::make('date')
                ->requiredMapping()
                ->rules(['required', 'date'])
                ->label('Date'),
            ImportColumn::make('open_time')
                ->requiredMapping()
                ->rules(['required'])
                ->label('Open item'),
            ImportColumn::make('close_time')
                ->requiredMapping()
                ->rules(['required'])
                ->label('Close time'),
            ImportColumn::make('priority_level')
                ->requiredMapping()
                ->rules(['required'])
                ->label('Priority level'),
            ImportColumn::make('category')
                ->requiredMapping()
                ->rules(['required'])
                ->label('Category'),
            ImportColumn::make('description')
                ->requiredMapping()
                ->rules(['required'])
                ->label('Description'),
            ImportColumn::make('type_device')
                ->requiredMapping()
                ->label('Type device')
                ->rules(['required']),
            ImportColumn::make('operation_system')
                ->requiredMapping()
                ->label('Operation system')
                ->rules(['required']),
            ImportColumn::make('software_or_application')
                ->requiredMapping()
                ->label('Software or application')
                ->rules(['required', 'max:255']),
            ImportColumn::make('error_message')
                ->requiredMapping()
                ->label('Error message'),
            ImportColumn::make('step_taken')
                ->label('Step taken'),
            ImportColumn::make('ticket_status')
                ->requiredMapping()
                ->label('Ticket status')
                ->rules(['required']),
        ];
    }

    public function resolveRecord(): ?Ticket
    {
        // return Ticket::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Ticket();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your ticket import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
    // public function resolveRecord(): ?Ticket
    // {
    //     return Ticket::firstOrNew([
    //         'ticket_number' => $this->data['ticket_number'],
    //     ]);
    // }
    public static function getOptionsFormComponents(): array
    {
        return [
            Checkbox::make('updateExisting')
                ->label('Update existing records'),
        ];
    }
}

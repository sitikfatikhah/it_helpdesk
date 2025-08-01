<?php

namespace App\Filament\Imports;

use App\Models\Ticket;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;


class TicketImporter extends Importer
{
    protected static ?string $model = Ticket::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('user_id')
                ->label('User ID')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('department.name')
                ->label('Department')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('ticket_number')
                ->label('Ticket Number')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('date')
                ->label('Date')
                ->requiredMapping()
                ->rules(['required', 'date']),
            ImportColumn::make('open_time')
                ->label('Open Time')
                ->requiredMapping()
                ->rules(['required']),
            // ImportColumn::make('close_time')
            //     ->label('Close Time')
            //     ->requiredMapping()
            //     ->rules(['required']),
            ImportColumn::make('priority_level')
                ->label('Priority Level')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('category')
                ->label('Category')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('description')
                ->label('Description')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('type_device')
                ->label('Type Device')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('operation_system')
                ->label('Operation System')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('software_or_application')
                ->label('Software or Application')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('error_message'),
            ImportColumn::make('step_taken'),
            ImportColumn::make('ticket_status')
                ->requiredMapping()
                ->rules(['required']),
        ];
    }

    public function resolveRecord(): ?Ticket
    {
          return User::firstOrNew([
            'ticket_number' => $this->data['ticket_number'],
        ]);

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
}

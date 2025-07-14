<?php

namespace App\Filament\Exports;

use App\Models\Ticket;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class TicketExporter extends Exporter
{
    protected static ?string $model = Ticket::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('user_id'),
            ExportColumn::make('department'),
            ExportColumn::make('ticket_number'),
            ExportColumn::make('date'),
            ExportColumn::make('open_time'),
            // ExportColumn::make('close_time'),
            ExportColumn::make('priority_level'),
            ExportColumn::make('category'),
            ExportColumn::make('description'),
            ExportColumn::make('type_device'),
            ExportColumn::make('operation_system'),
            ExportColumn::make('software_or_application'),
            ExportColumn::make('error_message'),
            ExportColumn::make('step_taken'),
            ExportColumn::make('ticket_status'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your ticket export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}

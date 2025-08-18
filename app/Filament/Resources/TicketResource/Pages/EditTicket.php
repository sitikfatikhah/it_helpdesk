<?php

namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Resources\TicketResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTicket extends EditRecord
{
    // Mengaitkan halaman ini dengan sumber daya (resource) TicketResource
    protected static string $resource = TicketResource::class;

    // Menentukan tindakan (actions) yang tersedia di header halaman
    protected function getHeaderActions(): array
    {
        return [
            // Tindakan untuk melihat (view) tiket
            Actions\ViewAction::make(),
            // Tindakan untuk menghapus (delete) tiket
            Actions\DeleteAction::make(),
        ];
    }


}

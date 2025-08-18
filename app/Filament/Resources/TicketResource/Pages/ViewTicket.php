<?php

namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Resources\TicketResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class ViewTicket extends ViewRecord
{
    // Mengaitkan halaman ini dengan sumber daya (resource) TicketResource
    protected static string $resource = TicketResource::class;

    // Menentukan tindakan (actions) yang tersedia di header halaman
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),   // Tombol Edit
            Actions\DeleteAction::make(), // Tombol Delete
            Actions\Action::make('back') // Tombol Kembali
                ->label('Kembali ke daftar tiket')
                ->color('secondary')
                ->url(TicketResource::getUrl('index')),
        ];
    }
}

<?php

namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Resources\TicketResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Filament\Notifications\Actions\Action;

class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;

    protected function afterCreate(): void
    {
        // Get the newly created ticket record.
        $ticket = $this->getRecord();

        Notification::make()
                ->title('New ticket from ' . Auth::user()->name)
                ->body('Ticket Number: ' . $ticket->ticket_number)
                ->actions([
                    Action::make('view')
                        ->button()
                        ->url(TicketResource::getUrl('view', ['record' => $ticket]))
                        ->markAsRead(),
                ])
                ->sendToDatabase(
                    User::role('super_admin')->get()
                );

    }


    protected function getRedirectUrl(): string
    {
        return TicketResource::getUrl('index');
    }
}

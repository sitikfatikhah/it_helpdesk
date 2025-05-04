<?php

namespace App\Filament\Widgets;

use App\Models\Ticket;
use App\Models\Report;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;



class StatsDashboard extends BaseWidget
{
    protected function getStats(): array
    {
        $countTicket = Ticket::count();
        $countTicketStatus = DB::Table('report')->count();

        $onProgressCount = DB::table('report')->where('ticket_status', 'on_progress')->count();
        $solvedCount = DB::table('report')->where('ticket_status', 'solved')->count();
        $callbackCount = DB::table('report')->where('ticket_status', 'callback')->count();
        return [
            Stat::make(label: 'Total Ticket', value: $countTicket  . ' Ticket'),
            Stat::make(label: 'On Progress', value: $onProgressCount  . ' ')
            ->extraAttributes([
                'class' => 'bg-yellow-100 text-yellow-800 border-2 border-yellow-300 rounded-ticket-style shadow-md px-6 py-4 font-semibold',]),
            Stat::make(label: 'Solved', value: $solvedCount  . ' '),
            Stat::make(label: 'Total Ticket', value: $callbackCount  . ' '),

        ];
    }
}

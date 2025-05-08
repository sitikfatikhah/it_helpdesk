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
        
        //count by status
        $countTicketStatus = DB::Table('Ticket')->count();

        $countonProgress = DB::table('Ticket')
            ->where('ticket_status','on_progress')
            ->count();
        $countsolved = DB::table('Ticket')
            ->where('ticket_status', 'solved')
            ->count();
        $countcallback = DB::table('Ticket')
            ->where('ticket_status', 'callback')
            ->count();

        return [
            Stat::make(label: 'Total Ticket', value: $countTicket  . ' Ticket'),

            Stat::make(label: 'On progress', value: $countonProgress)
                ->description('Tickets on progress')
                ->icon('heroicon-o-clock')
                ->color('success'),
            Stat::make(label: 'Solved', value: $countsolved)
                ->description('Tickets solved')
                ->icon('heroicon-o-check')
                ->color('info'),
            Stat::make(label: 'Callback', value: $countcallback)
                ->description('Tickets callback')
                ->icon('heroicon-o-arrow-path')
                ->color('warning'),

            // Stat::make(label: 'Solved', value: $solvedCount  . ' ')
                
            //     ->extraAttributes([
            //         'class' => 'border-yellow-300 border-2 bg-yellow-50 text-yellow-900 font-semibold',
            //     ]),

        ];
    }
}

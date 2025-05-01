<?php

namespace App\Filament\Widgets;

use App\Models\Ticket;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;



class StatsDashboard extends BaseWidget
{
    protected function getStats(): array
    {
        $countTicket = Ticket::count();
        return [
            Stat::make(label: 'Total Ticket', value: $countTicket  . ' Ticket'),
            Stat::make(label: 'Bounce rate', value: '21%'),
            Stat::make(label: 'Average time on page', value: '3:12'),
        ];
    }
}

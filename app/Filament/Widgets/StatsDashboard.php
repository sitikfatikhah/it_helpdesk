<?php

namespace App\Filament\Widgets;

use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsDashboard extends BaseWidget
{
    protected static ?int $sort = 2;

    public ?string $from = null;
    public ?string $to = null;

    protected function getListeners(): array
    {
        return ['filtersUpdated' => 'updateFilters'];
    }

    public function mount(): void
    {
        $this->from = Session::get('filters.from');
        $this->to = Session::get('filters.to');
    }

    public function updateFilters($payload): void
    {
        $this->from = $payload['from'] ?? null;
        $this->to = $payload['to'] ?? null;
    }

    protected function getStats(): array
    {
        $query = Ticket::query();

        if ($this->from) {
            $query->whereDate('created_at', '>=', $this->from);
        }

        if ($this->to) {
            $query->whereDate('created_at', '<=', $this->to);
        }

        $total = $query->count();

        $onProgress = (clone $query)->where('ticket_status', 'on_progress')->count();
        $solved = (clone $query)->where('ticket_status', 'solved')->count();
        $callback = (clone $query)->where('ticket_status', 'callback')->count();

        return [
            Stat::make('Total Tickets', "{$total} Ticket"),
            Stat::make('On Progress', $onProgress)
                ->description('Tickets on progress')
                ->icon('heroicon-o-clock')
                ->color('success'),
            Stat::make('Solved', $solved)
                ->description('Tickets solved')
                ->icon('heroicon-o-check')
                ->color('info'),
            Stat::make('Callback', $callback)
                ->description('Tickets callback')
                ->icon('heroicon-o-arrow-path')
                ->color('warning'),
        ];
    }
}

<?php

namespace App\Filament\Widgets;

use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsDashboard extends BaseWidget
{
    protected static ?int $sort = 2;

    public ?string $from = null;
    public ?string $to = null;

    public static function canView(): bool
    {
        $user = Auth::user();

        // Super admin bisa melihat widget ini
        if ($user->hasRole('super_admin')) {
            return true;
        }

        // Pengguna biasa hanya bisa melihat jika mereka punya tiket
        return Ticket::where('user_id', $user->id)->exists();
    }

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
        $user = Auth::user();
        $query = Ticket::query();

        // Jika pengguna BUKAN super_admin, filter tiket sesuai user_id yang login.
        if (!$user->hasRole('super_admin')) {
            $query->where('user_id', $user->id);
        }

        if ($this->from) {
            $query->whereDate('created_at', '>=', $this->from);
        }

        if ($this->to) {
            $query->whereDate('created_at', '<=', $this->to);
        }

        $total = $query->count();

        $onProgress = (clone $query)->where('ticket_status', 'on_progress')->count();
        $solved = (clone $query)->where('ticket_status', 'solved')->count();
        $callback = (clone $query)->whereIn('ticket_status', ['callback', 'monitored', 'other'])->count();

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
            Stat::make('Callback / Monitored / Other', $callback)
                ->description('Tickets Callback / Monitored / Other')
                ->icon('heroicon-o-arrow-path')
                ->color('warning'),
        ];
    }
}

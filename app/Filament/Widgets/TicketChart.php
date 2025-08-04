<?php

namespace App\Filament\Widgets;

use App\Models\Ticket;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Carbon;

class TicketChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?string $heading = 'Tiket priority';

    protected int|string|array $columnSpan = '1';

    protected static ?int $sort = 3;

    public ?string $filter = 'year';

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        // Tentukan tanggal awal, tanggal akhir, dan format tanggal berdasarkan filter.
        switch ($activeFilter) {
            case 'today':
                $startDate = now()->startOfDay();
                $endDate = now()->endOfDay();
                $dateFormat = '%Y-%m-%d';
                break;
            case 'week':
                $startDate = now()->subWeek()->startOfDay();
                $endDate = now()->endOfDay();
                $dateFormat = '%Y-%m-%d';
                break;
            case 'month':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                $dateFormat = '%Y-%m';
                break;
            case 'year':
            default:
                $startDate = now()->startOfYear();
                $endDate = now()->endOfYear();
                $dateFormat = '%Y-%m';
                break;
        }

        // Query untuk mengambil data tiket, digabungkan berdasarkan tanggal dan level prioritas.
        $data = Ticket::query()
            ->selectRaw("DATE_FORMAT(created_at, '{$dateFormat}') as date, priority_level, COUNT(*) as aggregate")
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupByRaw("DATE_FORMAT(created_at, '{$dateFormat}'), priority_level")
            ->orderByRaw("DATE_FORMAT(created_at, '{$dateFormat}') ASC")
            ->get();

        // Mengambil semua tanggal unik untuk label sumbu-X
        $labels = $data->pluck('date')->unique()->sort()->values()->toArray();

        // Mengambil semua level prioritas unik untuk setiap dataset
        $priorityLevels = $data->pluck('priority_level')->unique()->sort()->values();

        // Mendefinisikan palet warna untuk setiap level prioritas
        $colorPalette = [
            'low' => '#3B82F6',    // Biru untuk prioritas rendah
            'medium' => '#F59E0B', // Kuning untuk prioritas sedang
            'high' => '#EF4444',   // Merah untuk prioritas tinggi
        ];

        $datasets = [];

        // Membuat dataset terpisah untuk setiap level prioritas
        foreach ($priorityLevels as $priorityLevel) {
            $priorityData = $data->where('priority_level', $priorityLevel);

            // Memetakan agregat ke label tanggal yang benar
            $datasetData = [];
            foreach ($labels as $label) {
                $count = $priorityData->where('date', $label)->first()->aggregate ?? 0;
                $datasetData[] = $count;
            }

            $datasets[] = [
                'label' => 'Level ' . ucfirst($priorityLevel),
                'data' => $datasetData,
                'backgroundColor' => $colorPalette[$priorityLevel] ?? '#6B7280', // Warna default jika tidak ditemukan
                'borderColor' => $colorPalette[$priorityLevel] ?? '#6B7280',
                'borderWidth' => 1,
            ];
        }

        $labelFormated = [];
        foreach ($labels as $label) {
            $labelFormated[]=Carbon::parse($label)->format('Y-m-d');
        }

        return [
            'datasets' => $datasets,
            'labels' => $labelFormated,
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Atau 'line', 'pie', dsb
    }
}

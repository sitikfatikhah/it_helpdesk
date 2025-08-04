<?php

namespace App\Filament\Widgets;

use App\Models\Ticket;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Carbon;

class TicketChartCategory extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?string $heading = 'Ticket by Category';

    // ✅ Full width
    protected int|string|array $columnSpan = '1';

    protected static ?int $sort = 3;

    public ?string $filter = 'year';

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last Week',
            'month' => 'Last Month',
            'year' => 'This Year',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        // ⏱ Define time range and date format
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

        // 📊 Get ticket data grouped by category and date
        $data = Ticket::query()
            ->selectRaw("DATE_FORMAT(created_at, '{$dateFormat}') as date, category, COUNT(*) as aggregate")
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupByRaw("DATE_FORMAT(created_at, '{$dateFormat}'), category")
            ->orderByRaw("DATE_FORMAT(created_at, '{$dateFormat}') ASC")
            ->get();

        $labels = $data->pluck('date')->unique()->sort()->values()->toArray();
        $categories = $data->pluck('category')->unique()->sort()->values();

        // 🎨 Optional color palette
        $colorPalette = [
            'software' => '#3B82F6',
            'hardware' => '#F59E0B',
            'network' => '#EF4444',
            'other' => '#10B981',
        ];

        $datasets = [];

        foreach ($categories as $category) {
            $categoryData = $data->where('category', $category);

            $datasetData = [];
            foreach ($labels as $label) {
                $count = $categoryData->firstWhere('date', $label)?->aggregate ?? 0;
                $datasetData[] = $count;
            }

            $datasets[] = [
                'label' => ucfirst($category),
                'data' => $datasetData,
                'backgroundColor' => $colorPalette[$category] ?? '#6B7280',
                'borderColor' => $colorPalette[$category] ?? '#6B7280',
                'borderWidth' => 1,
            ];
        }

        // Format ulang label tanggal (opsional)
        $labelFormatted = array_map(
            fn ($label) => Carbon::parse($label)->format('Y-m-d'),
            $labels
        );

        return [
            'datasets' => $datasets,
            'labels' => $labelFormatted,
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Bisa diganti dengan 'line', 'pie', dll.
    }
}

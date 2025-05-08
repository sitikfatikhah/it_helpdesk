<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ReportChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected static ?string $description = 'An overview of some analytics.';

    protected function getData(): array
    {
        // Ambil data ticket berdasarkan bulan
        $data = DB::table('ticket')
            ->selectRaw('MONTH(date) as month, COUNT(ticket_number) as quantity')
            ->groupByRaw('MONTH(date)')
            ->orderByRaw('MONTH(date)')
            ->get();

        // Label bulan (angka ke nama bulan)
        $labels = $data->pluck('month')->map(function ($month) {    
            return date("F", mktime(0, 0, 0, (int) $month, 1));
        })->toArray();

        // Jumlah tiket
        $dataset = $data->pluck('total')->toArray();

        return [
            'dataset' => [
                [
                'label' => 'Quantity',
                'data' => 'datasets',
                'backgroundColor' => '#3b82f6',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}

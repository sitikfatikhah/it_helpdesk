<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Ticket;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class TicketChart extends ChartWidget
{
    protected static ?string $heading = 'Ticket Chart';

    protected int | string | array $columnSpan = '1';

    use InteractsWithPageFilters;


    protected function getData(): array
    {
        $startDate = $this->filters('created_at');
        $endDate = $this->filters('updated_at');

        $data = Trend::model(Ticket::class)
        ->between(
            start: $start ? Carbon::parse($start) : now()->subMonth(6),
            end: $end ? Carbon::parse($end) : now(),
        )
        ->perMonth()
        ->count();


        return [
             'datasets' => [
            [
                'label' => 'Ticket',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
            ],
        ],
        'labels' => $data->map(fn (TrendValue $value) => $value->date),

        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}

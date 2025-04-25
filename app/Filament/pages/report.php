<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Pages\Page;
use App\Models\Ticket;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class Report extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = '<x-tabler-report-analytics />';
    protected static ?string $navigationLabel = 'Ticket Report';
    protected static string $view = 'filament.pages.report';

    public ?string $from_date = null;
    public ?string $to_date = null;
    public ?string $category = null;

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            DatePicker::make('from_date')->label('From Date'),
            DatePicker::make('to_date')->label('To Date'),
            Select::make('category')
                ->options([
                    'hardware' => 'Hardware',
                    'software' => 'Software',
                    'network' => 'Network',
                    'other' => 'Other',
                ])
                ->label('Category')
                ->placeholder('All Categories'),
        ];
    }

    public function getTickets()
    {
        $query = Ticket::query();

        if ($this->from_date && $this->to_date) {
            $query->whereBetween('date', [$this->from_date, $this->to_date]);
        }

        if ($this->category) {
            $query->where('category', $this->category);
        }

        return $query->get();
    }

    protected function getViewData(): array
    {
        return [
            'tickets' => $this->getTickets(),
            'form' => $this->form,
        ];
    }
}

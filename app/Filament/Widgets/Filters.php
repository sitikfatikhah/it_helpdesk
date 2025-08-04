<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Filament\Forms\Form;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Illuminate\Support\Facades\Session;

class Filters extends Widget implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.widgets.filters';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 1;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'from' => Session::get('filters.from'),
            'to'   => Session::get('filters.to'),
        ]);
    }

    public function updatedData(): void
    {
        Session::put('filters.from', $this->data['from'] ?? null);
        Session::put('filters.to', $this->data['to'] ?? null);

        $this->dispatch('filtersUpdated', [
            'from' => $this->data['from'],
            'to' => $this->data['to'],
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Grid::make()
                    ->schema([
                        DatePicker::make('from')
                            ->reactive()
                            ->afterStateUpdated(fn () => $this->updatedData()),

                        DatePicker::make('to')
                            ->reactive()
                            ->afterStateUpdated(fn () => $this->updatedData()),
                    ]),
            ]);
    }
}

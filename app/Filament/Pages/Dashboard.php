<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;


class Dashboard extends \Filament\Pages\Dashboard
{
     use HasFiltersForm;

     public function filtersForm(Form $form): Form
    {
        return $form->schema([
            section::make('')->schema([
            TextInput::make('name'),
            DatePicker::make('created_at'),
            DatePicker::make('updated_at'),
            Toggle::make('active'),
            ])->columns(4)
        ]);
    }
}


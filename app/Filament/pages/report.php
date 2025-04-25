<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Report extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.report'; // View Blade

    protected static ?string $slug = 'report'; // Ini URL-nya => /app/report
}

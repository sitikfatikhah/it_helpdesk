<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Report extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.report';

    protected static ?string $title = 'Laporan Tiket Masuk';
    protected static ?string $navigationLabel = 'Report';
}

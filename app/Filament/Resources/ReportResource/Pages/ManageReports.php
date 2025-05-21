<?php

namespace App\Filament\Resources\ReportResource\Pages;

use App\Filament\Resources\ReportResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageReports extends ManageRecords
{
    protected static string $resource = ReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            Actions\ButtonAction::make('Report pdf')->url(fn()=> route('download.tes'))
            ->openUrlInNewTab(),
            Actions\CreateAction::make(),
        ];
    }
}

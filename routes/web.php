<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/app');
});

Route::get('/reports/export/pdf', [ReportController::class, 'exportPdf'])->name('reports.export.pdf');
Route::get('/reports/export/excel', [ReportController::class, 'exportExcel'])->name('reports.export.excel');


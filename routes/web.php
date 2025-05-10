<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomLoginController;
use Illuminate\Http\Request;


// Route::get('/', function () {
//     return redirect('/app');
// });

Route::get('/reports/export/pdf', [ReportController::class, 'exportPdf'])->name('reports.export.pdf');
Route::get('/reports/export/excel', [ReportController::class, 'exportExcel'])->name('reports.export.excel');
Route::get('/login-custom', [CustomLoginController::class, 'showLogin']);
Route::post('/submit-ticket', function (Request $request) {
    // // Lakukan logika simpan ticket di sini
    // Ticket::create($request->all());

    return redirect('/app'); // redirect ke dashboard Laravel
});


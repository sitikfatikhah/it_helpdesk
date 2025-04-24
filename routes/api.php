<?php

use App\Http\Controllers\ReportController;

Route::get('/reports', [ReportController::class, 'index']);
Route::get('/reports/{id}', [ReportController::class, 'show']);
Route::post('/reports', [ReportController::class, 'store']);
Route::put('/reports/{id}', [ReportController::class, 'update']);
Route::delete('/reports/{id}', [ReportController::class, 'destroy']);
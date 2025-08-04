    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\CustomLoginController;
    use App\Http\Controllers\PDFController;
    use App\Http\Controllers\ReportController;
    use Illuminate\Http\Request;


    Route::get('/', function () {
        return redirect('/app');
    });

    Route::get('/reports/export/pdf', [ReportController::class, 'exportPdf'])->name('reports.export.pdf');
    Route::get('/reports/export/excel', [ReportController::class, 'exportExcel'])->name('reports.export.excel');
    Route::get('/login-custom', [CustomLoginController::class, 'showLogin']);
    Route::post('/submit-ticket', function (Request $request) {


        return redirect('/app'); // redirect ke dashboard Laravel
    });

    Route::get('download', [PDFController::class, 'downloadpdf'])->name('download.tes');
    // PDF Download Routes
    Route::get('/download-pdf', [PDFController::class, 'downloadpdf'])->name('download.pdf'); // untuk semua tiket
    Route::get('/download-bulk-pdf', [PDFController::class, 'downloadBulk'])->name('download.bulk.pdf'); // untuk bulk
    Route::get('/download-pdf/{id}', [PDFController::class, 'reportpdf'])->name('download.pdf.detail'); // untuk 1 tiket


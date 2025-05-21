<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function downloadpdf()
    {
        $report = Ticket::all(); 

        $data = [
            'title' => 'Laporan Tiket IT Helpdesk',
            'date' => date('d/m/Y'),
            'report' => $report,
        ];

        $pdf = PDF::loadView('ReportPDF', $data); // pastikan view 'ReportPDF.blade.php' ada

        return $pdf->download('laporan-tiket.pdf'); 
    }

    public function reportpdf($id)
    {
        $report = Ticket::findOrFail($id);

        $data = [
            'title' => 'Detail Tiket',
            'date' => date('d/m/Y'),
            'report' => $report,
        ];

        $pdf = PDF::loadView('ReportPDF', $data);

        return $pdf->download('detail-tiket-' . $id . '.pdf');
    }

    public function downloadBulk()
    {
        $ids = session('export_ids', []);
        $reports = Ticket::whereIn('id', $ids)->get(); // Gunakan Ticket, bukan Report

        $data = [
            'reports' => $reports,
            'date' => now()->format('d/m/Y'),
            'title' => 'Laporan Tiket Bulk',
        ];

        $pdf = PDF::loadView('ReportPDF', $data);

        return $pdf->download('bulk-laporan-tiket.pdf');
    }
}

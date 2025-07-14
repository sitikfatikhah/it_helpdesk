<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportsExport;

class ReportController extends Controller
{
    // Tampilkan semua laporan
    public function index()
    {
        return Report::with(['user', 'department'])->get();
    }

    // Tampilkan satu laporan berdasarkan ID
    public function show($id)
    {
        return Report::with(['user', 'department'])->findOrFail($id);
    }

    // Simpan laporan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'department_id' => 'required|exists:users,department',
            'ticket_number' => 'required|unique:reports,ticket_number',
            'date' => 'required|date',
            'open_time' => 'nullable',
            // 'close_time' => 'nullable',
            'priority_level' => 'required|in:low,medium,high',
            'category' => 'required',
            'description' => 'required',
            'type_device' => 'required',
            'operation_system' => 'required',
            'software_or_application' => 'required',
            'error_message' => 'nullable',
            'step_taken' => 'nullable',
            'ticket_status' => 'required|in:open,in_progress,closed',
        ]);

        return Report::create($validated);
    }

    // Update laporan
    public function update(Request $request, $id)
    {
        $report = Report::findOrFail($id);

        $validated = $request->validate([
            'ticket_status' => 'in:open,in_progress,closed',
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        $report->update($validated);

        return response()->json(['message' => 'Report updated successfully', 'report' => $report]);
    }

    // Hapus laporan
    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return response()->json(['message' => 'Report deleted successfully']);
    }

    public function exportPdf()
    {
    $reports = Report::with(['user', 'department'])->get();
    $pdf = Pdf::loadView('exports.reports-pdf', compact('reports'));

    return $pdf->download('reports.pdf')
    ;}
    public function exportExcel()
    {
    return Excel::download(new ReportsExport, 'reports.xlsx')
    ;}


}

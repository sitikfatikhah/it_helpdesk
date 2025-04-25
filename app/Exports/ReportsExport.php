<?php
namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportsExport implements FromCollection
{
    public function collection()
    {
        return Report::with(['user', 'department'])->get();
    }
}

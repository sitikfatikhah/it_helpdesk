<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'department_id',
        'ticket_number',
        'date',
        'open_time',
        'close_time',
        'priority_level',
        'category',
        'description',
        'type_device',
        'operation_system',
        'software_or_application',
        'error_message',
        'step_taken',
        'ticket_status',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Contoh scope: cari tiket dengan prioritas tinggi
    public function scopeHighPriority($query)
    {
        return $query->where('priority_level', 'high');
    }

    // Format tanggal laporan
    public function getFormattedDateAttribute()
    {
        return \Carbon\Carbon::parse($this->date)->format('d M Y');
    }

    // Format jam buka
    public function getOpenTimeFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->open_time)->format('H:i');
    }

    // Format jam tutup
    public function getCloseTimeFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->close_time)->format('H:i');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $table = 'report'; // karena nama tabel tidak jamak

    protected $fillable = [
        'user_id',
        'department',
        'ticket_number',
        'date',
        'open_time',
        // 'close_time',
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
}

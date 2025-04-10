<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_number',
        'date',
        'open_time',
        'close_time',
        'ticket_number',
        'priority_level',
        'category',
        'description',
        'type_device',
        'operation_system',
        'software_or_application',
        'error_message',
        'step_taken',
        'status_tiket',
    ];

    protected $casts = [
        'date' => 'date',
        'open_time' => 'datetime:H:i',
        'close_time' => 'datetime:H:i',
    ];

    // Relationship: Tiket belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

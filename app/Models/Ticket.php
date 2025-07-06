<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ticket extends Model
{
    use HasFactory;

    protected $table='ticket';

    protected $fillable = [
        'user_id',
        'department_id',
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

    protected $casts = [
        'date' => 'date',
        'open_time' => 'datetime:H:i',
        // 'close_time' => 'datetime:H:i',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ticket) {
            $today = now()->format('Ymd'); // Format: 20250411

            $countToday = DB::table('ticket')
                ->whereDate('created_at', now()->toDateString())
                ->count();

            $sequence = str_pad($countToday + 1, 3, '0', STR_PAD_LEFT);

            $ticket->ticket_number = 'TC-' . $today . '-' . $sequence;
        });
    }

    // Relationship: Ticket belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }



}

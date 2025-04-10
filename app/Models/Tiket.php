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
        'priority_level',
        'category',
        'type_device',
        'operation_system',
        'software_or_apps',
        'keluhan',
        'step_taken',
        'status_tiket',
    ];

    /**
     * Define the relationship with the User model.
     */
    public function user()  // Corrected method name to 'user' for consistency
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

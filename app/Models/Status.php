<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Status extends Model
{
    use HasFactory;

    protected $table='status';

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'date' => 'date',
        'open_time' => 'datetime:H:i',
        // 'close_time' => 'datetime:H:i',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}

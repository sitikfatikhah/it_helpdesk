<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Department extends Model
{
    use HasFactory;

    protected $table='departments';


    protected $fillable = [
        'name',
    ];

    public function ticket()
    {
    return $this->hasMany(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }




}


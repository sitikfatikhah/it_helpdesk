<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    

    protected $fillable = [
        'name',
    ];

    public function ticket()
    {
    return $this->hasMany(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}


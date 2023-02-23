<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    const STATUS_ACTIVE = 1;

    protected $fillable = [
        'title', 'description', 'start_date', 'due_date', 'achieved_at', 'status', 'comment'
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'user_id', 'goal_id', 'status', 'effort_time_minutes', 'date', 'comment'
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }
}

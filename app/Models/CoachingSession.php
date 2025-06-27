<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoachingSession extends Model
{
    protected $fillable = [
         'user_id',
    'coach_id',
    'session_date',
    'start_time',
    'end_time',
    'status',
];
protected $casts = [
    'date' => 'date',
];

public function coach()
{
    return $this->belongsTo(Coach::class);
}

public function facility()
{
    return $this->belongsTo(Facility::class);
}

public function user() {
    return $this->belongsTo(User::class);
}
}

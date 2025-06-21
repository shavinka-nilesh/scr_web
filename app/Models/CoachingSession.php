<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoachingSession extends Model
{
    protected $fillable = [
    'coach_id',
    'facility_id',
    'date',
    'time_slot',
    'available_slots',
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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    public function bookings()
{
    return $this->hasMany(Booking::class);
}
public function coachingSessions()
{
    return $this->hasMany(CoachingSession::class);
}

public function sportType()
{
    return $this->belongsTo(SportType::class);
}

protected $fillable = [
    'name',
    'location',
    'description',
    'capacity',
    'sport_type',
];
}

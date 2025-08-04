<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
     public function coachingSessions()
{
    return $this->hasMany(CoachingSession::class);
}
     public function bookings()
{
    return $this->hasMany(Booking::class);
}
public function sportType()
    {
        return $this->belongsTo(SportType::class);
    }
     protected $fillable = ['name', 'specialization', 'contact_number','sport_type_id'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function user()
{
    return $this->belongsTo(User::class);
}
public function coach()
{
    return $this->belongsTo(Coach::class);
}
public function facility()
{
    return $this->belongsTo(Facility::class);
}
public function sportType()
{
    return $this->belongsTo(SportType::class);
}
protected $fillable = [
    'user_id',
    'facility_id',
    'date',
    'start_time',
    'end_time',
    'status',
    'sport_type_id',
    'coach_id'
];
protected $casts = [
    'date' => 'date',
];
}

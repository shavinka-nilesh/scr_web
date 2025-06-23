<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function user()
{
    return $this->belongsTo(User::class);
}

public function facility()
{
    return $this->belongsTo(Facility::class);
}
protected $fillable = [
    'user_id',
    'facility_id',
    'date',
    'start_time',
    'end_time',
    'status', // pending, paid, cancelled
];
protected $casts = [
    'date' => 'date',
];
}

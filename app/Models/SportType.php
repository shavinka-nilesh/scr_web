<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SportType extends Model
{
    public function facility()
{
    return $this->hasMany(Facility::class);
}
    public function bookings()
{
    return $this->hasMany(Booking::class);
}
protected $fillable = [
    'name',
    'description',
];


}

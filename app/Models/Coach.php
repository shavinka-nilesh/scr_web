<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
     public function coachingSessions()
{
    return $this->hasMany(CoachingSession::class);
}
     protected $fillable = ['name', 'specialization', 'contact_number'];
}

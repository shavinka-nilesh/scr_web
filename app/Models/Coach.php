<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
     protected $fillable = ['name', 'specialization', 'contact_number'];
}

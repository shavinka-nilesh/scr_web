<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityImage extends Model
{
public function facility()
{
    return $this->belongsTo(Facility::class);
}


protected $fillable = ['path'];


}

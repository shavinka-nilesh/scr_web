<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SportType extends Model
{
    public function facility()
{
    return $this->hasMany(Facility::class);
}

protected $fillable = [
    'name',
    'description',
];


}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SportType;
class SportTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $types = [
            ['name'=>'Basketball',     'description'=>'Indoor court with hoops and bleachers.'],
            ['name'=>'Tennis',         'description'=>'Outdoor/indoor tennis courts with nets.'],
            ['name'=>'Football',       'description'=>'Grass or turf pitch with goals.'],
            ['name'=>'Badminton',      'description'=>'Wooden-floor courts with shuttles.'],
            ['name'=>'Swimming',       'description'=>'Olympic-size pool facility.'],
            ['name'=>'Volleyball',     'description'=>'Beach or indoor volleyball courts.'],
            ['name'=>'Cricket',        'description'=>'Professional cricket ground.'],
            ['name'=>'Gymnastics',     'description'=>'Full gym with apparatus.'],
            ['name'=>'Yoga',           'description'=>'Quiet studio for yoga classes.'],
            ['name'=>'Skating',        'description'=>'Rinks and ramps for skating.'],
            ['name'=>'Boxing',         'description'=>'Ring and padded training area.'],
            ['name'=>'Athletics',      'description'=>'Track & field facilities.'],
            ['name'=>'Karate',         'description'=>'Dojo with mats for martial arts.'],
            ['name'=>'Archery',        'description'=>'Outdoor archery ranges.'],
        ];

        foreach ($types as $t) {
            SportType::create($t);
        }
    }
}

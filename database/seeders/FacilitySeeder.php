<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Facility;
class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            ['name'=>'Grand Arena','sport_type'=>'Basketball','location'=>'Colombo 01','capacity'=>300,'description'=>'Indoor wooden court with seating.'],
            ['name'=>'Ocean View Court','sport_type'=>'Tennis','location'=>'Galle','capacity'=>100,'description'=>'Outdoor court near the sea.'],
            ['name'=>'Skyline Gym','sport_type'=>'Gymnastics','location'=>'Kandy','capacity'=>150,'description'=>'Fully equipped modern gym.'],
            ['name'=>'Green Turf','sport_type'=>'Football','location'=>'Negombo','capacity'=>400,'description'=>'Grass football field.'],
            ['name'=>'City Badminton Center','sport_type'=>'Badminton','location'=>'Colombo 07','capacity'=>120,'description'=>'Wooden floor badminton court.'],
            ['name'=>'Aqua Pool Complex','sport_type'=>'Swimming','location'=>'Nugegoda','capacity'=>80,'description'=>'Olympic size swimming pool.'],
            ['name'=>'Sunset Beach Court','sport_type'=>'Volleyball','location'=>'Mount Lavinia','capacity'=>200,'description'=>'Beach volleyball setup.'],
            ['name'=>'Highland Cricket Oval','sport_type'=>'Cricket','location'=>'Kandy','capacity'=>500,'description'=>'Professional level cricket ground.'],
            ['name'=>'Urban Skate Park','sport_type'=>'Skating','location'=>'Colombo 03','capacity'=>100,'description'=>'Concrete ramps and half-pipes.'],
            ['name'=>'Hilltop Boxing Club','sport_type'=>'Boxing','location'=>'Peradeniya','capacity'=>60,'description'=>'Boxing ring and training area.'],
            ['name'=>'City Yoga Hall','sport_type'=>'Yoga','location'=>'Dehiwala','capacity'=>50,'description'=>'Quiet indoor yoga facility.'],
            ['name'=>'Speedway Track','sport_type'=>'Athletics','location'=>'Anuradhapura','capacity'=>300,'description'=>'400m synthetic track.'],
            ['name'=>'Downtown Martial Arts Center','sport_type'=>'Karate','location'=>'Bambalapitiya','capacity'=>75,'description'=>'Dojo with padded flooring.'],
            ['name'=>'Mountain Archery Range','sport_type'=>'Archery','location'=>'Nuwara Eliya','capacity'=>40,'description'=>'Outdoor target lanes.'],
        ];

        foreach ($facilities as $data) {
            Facility::create($data);
        }
    
    }
}

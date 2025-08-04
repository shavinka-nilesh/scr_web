<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Coach;
class CoachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coaches = [
            ['name'=>'John Silva','specialization'=>'Basketball','contact_number'=>'0711234567'],
            ['name'=>'Amal Perera','specialization'=>'Tennis','contact_number'=>'0722345678'],
            ['name'=>'Nirosha Fernando','specialization'=>'Gymnastics','contact_number'=>'0753456789'],
            ['name'=>'Kasun Jayasuriya','specialization'=>'Football','contact_number'=>'0764567890'],
            ['name'=>'Samantha Dias','specialization'=>'Badminton','contact_number'=>'0775678901'],
            ['name'=>'Michael Gomez','specialization'=>'Swimming','contact_number'=>'0786789012'],
            ['name'=>'Dilani Herath','specialization'=>'Volleyball','contact_number'=>'0797890123'],
            ['name'=>'Aravinda Silva','specialization'=>'Cricket','contact_number'=>'0708901234'],
            ['name'=>'Hiruni Abeywickrama','specialization'=>'Skating','contact_number'=>'0719012345'],
            ['name'=>'Suresh Wickramasinghe','specialization'=>'Boxing','contact_number'=>'0720123456'],
            ['name'=>'Nilmini Karunaratne','specialization'=>'Yoga','contact_number'=>'0731234567'],
            ['name'=>'Manoj Ranasinghe','specialization'=>'Athletics','contact_number'=>'0742345678'],
            ['name'=>'Thilina Rathnayake','specialization'=>'Karate','contact_number'=>'0753456780'],
            ['name'=>'Lahiru Bandara','specialization'=>'Archery','contact_number'=>'0764567891'],
        ];

        foreach ($coaches as $data) {
            Coach::create($data);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OpeningTime;

class OpeningTimeSeeder extends Seeder
{
    public function run()
    {
        OpeningTime::create(['day_name' => 'Maandag', 'start_time' => '14:00', 'end_time' => '22:00']);
        OpeningTime::create(['day_name' => 'Dinsdag', 'start_time' => '14:00', 'end_time' => '22:00']);
        OpeningTime::create(['day_name' => 'Woensdag', 'start_time' => '14:00', 'end_time' => '22:00']);
        OpeningTime::create(['day_name' => 'Donderdag', 'start_time' => '14:00', 'end_time' => '22:00']);
        OpeningTime::create(['day_name' => 'Vrijdagmiddag', 'start_time' => '14:00', 'end_time' => '18:00']);
        OpeningTime::create(['day_name' => 'Vrijdagavond', 'start_time' => '18:00', 'end_time' => '24:00']);
        OpeningTime::create(['day_name' => 'Zaterdagmiddag', 'start_time' => '14:00', 'end_time' => '18:00']);
        OpeningTime::create(['day_name' => 'Zaterdagavond', 'start_time' => '18:00', 'end_time' => '24:00']);
        OpeningTime::create(['day_name' => 'Zondagmiddag', 'start_time' => '14:00', 'end_time' => '18:00']);
        OpeningTime::create(['day_name' => 'Zondagavond', 'start_time' => '18:00', 'end_time' => '24:00']);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OpeningTime;

class OpeningTimeSeeder extends Seeder
{
    public function run()
    {
        OpeningTime::create(['day_name' => 'Monday', 'start_time' => '08:00', 'end_time' => '22:00']);
        OpeningTime::create(['day_name' => 'Tuesday', 'start_time' => '08:00', 'end_time' => '22:00']);
        // Add more days as needed
    }
}


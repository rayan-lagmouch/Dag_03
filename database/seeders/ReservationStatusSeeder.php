<?php

namespace Database\Seeders;

use App\Models\ReservationStatus;
use Illuminate\Database\Seeder;

class ReservationStatusSeeder extends Seeder
{
    public function run()
    {
        // Adding some example statuses
        ReservationStatus::create(['name' => 'confirmed', 'is_active' => true]);
        ReservationStatus::create(['name' => 'pending', 'is_active' => true]);
    }
}

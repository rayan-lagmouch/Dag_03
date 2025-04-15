<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReservationStatus;

class ReservationStatusSeeder extends Seeder
{
    public function run()
    {
        ReservationStatus::create(['name' => 'pending']);
        ReservationStatus::create(['name' => 'confirmed']);
        ReservationStatus::create(['name' => 'canceled']);
    }
}

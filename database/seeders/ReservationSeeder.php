<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\Person;
use App\Models\OpeningTime;
use App\Models\Lane;
use App\Models\PackageOption;
use App\Models\ReservationStatus;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        // Get actual IDs from seeded data
        $person = Person::first();
        $openingTime = OpeningTime::first();
        $lane = Lane::first();
        $package = PackageOption::first();
        $status = ReservationStatus::first();

        Reservation::create([
            'person_id' => 1, // Ensure a person with ID 1 exists
            'opening_time_id' => 1,
            'lane_id' => 1,
            'package_option_id' => 1,
            'reservation_status_id' => 2, // 2 = 'confirmed'
            'date' => '2025-04-12',
            'start_time' => '14:00:00',
            'end_time' => '15:00:00',
            'adult_count' => 2,
            'child_count' => 1,
            'is_active' => true,
        ]);
    }
}

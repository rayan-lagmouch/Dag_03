<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\Person;
use App\Models\PackageOption;
use App\Models\ReservationStatus;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        // Find reservation status (confirmed)
        $confirmedStatus = ReservationStatus::where('name', 'confirmed')->first();

        // Find package options
        $standardPackage = PackageOption::where('name', 'Standard')->first();
        $vipPackage = PackageOption::where('name', 'VIP')->first();

        // Find customers
        $customer = Person::where('nickname', 'JS')->first();

        // Creating sample confirmed reservations
        Reservation::create([
            'person_id' => $customer->id,
            'opening_time_id' => 1, // Assume this exists (replace with valid opening_time_id)
            'lane_id' => 1, // Assume lane_id 1 exists (replace with valid lane_id)
            'package_option_id' => $standardPackage->id,
            'reservation_status_id' => $confirmedStatus->id,
            'date' => now()->addDays(1),
            'start_time' => '18:00:00',
            'end_time' => '20:00:00',
            'adult_count' => 2,
            'child_count' => 1,
            'is_active' => true,
        ]);

        Reservation::create([
            'person_id' => $customer->id,
            'opening_time_id' => 2, // Assume this exists (replace with valid opening_time_id)
            'lane_id' => 2, // Assume lane_id 2 exists (replace with valid lane_id)
            'package_option_id' => $vipPackage->id,
            'reservation_status_id' => $confirmedStatus->id,
            'date' => now()->addDays(2),
            'start_time' => '20:00:00',
            'end_time' => '22:00:00',
            'adult_count' => 3,
            'child_count' => 0,
            'is_active' => true,
        ]);
    }
}

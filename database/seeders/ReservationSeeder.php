<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Person;
use App\Models\Reservation;
use App\Models\PackageOption;
use App\Models\OpeningTime;
use App\Models\Lane;
use App\Models\ReservationStatus;
use Carbon\Carbon;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure that there's at least one record in the 'person_types' table
        $personType = \App\Models\PersonType::first();
        if (!$personType) {
            $personType = \App\Models\PersonType::create([
                'name' => 'Customer',
                'is_active' => true,
            ]);
        }

        // Creating a sample person (ensure there's a PersonType with id 1)
        $person = Person::create([
            'first_name' => 'John',
            'middle_name' => 'Doe',
            'last_name' => 'Doe',
            'nickname' => 'Johnny',
            'is_adult' => true,
            'person_type_id' => $personType->id, // Ensure this is a valid person_type_id
        ]);

        // Ensure there are records in the 'opening_times', 'lanes', 'package_options', and 'reservation_statuses' tables
        $openingTime = OpeningTime::first();
        if (!$openingTime) {
            $openingTime = OpeningTime::create([
                'day_name' => 'Monday',
                'start_time' => '10:00',
                'end_time' => '22:00',
                'is_active' => true,
            ]);
        }

        $lane = Lane::first();
        if (!$lane) {
            $lane = Lane::create([
                'number' => 7,
                'has_fence' => false,
                'is_active' => true,
            ]);
        }

        $packageOption = PackageOption::first();
        if (!$packageOption) {
            $packageOption = PackageOption::create([
                'name' => 'Snack Packet Basic',
                'description' => 'A basic snack packet for guests.',
                'price' => 15.00,
            ]);
        }

        $reservationStatus = ReservationStatus::first();
        if (!$reservationStatus) {
            $reservationStatus = ReservationStatus::create([
                'name' => 'Pending',
                'is_active' => true,
            ]);
        }

        // Creating multiple reservation entries for different lanes (1 to 8)
        for ($i = 1; $i <= 8; $i++) {
            // Check if we are creating one of the two reservations without children
            $childCount = ($i <= 2) ? 0 : 5; // The first two lanes will not have children

            // For reservations with children, assign either lane 7 or lane 8
            if ($childCount > 0) {
                $laneId = ($i == 7 || $i == 8) ? $i : rand(7, 8); // Assign either lane 7 or 8 for reservations with children
            } else {
                // For reservations without children, we allow lanes 1 to 6
                $laneId = $i;
            }

            Reservation::create([
                'person_id' => $person->id,
                'opening_time_id' => $openingTime->id,
                'lane_id' => $laneId, // Assign lane 7 or 8 for reservations with children, else any lane 1-6
                'package_option_id' => $packageOption->id,
                'reservation_status_id' => $reservationStatus->id,
                'date' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'start_time' => '12:00', // Example start time
                'end_time' => '14:00', // Example end time
                'adult_count' => 10,
                'child_count' => $childCount, // Set child count based on the lane number
                'is_active' => true,
            ]);
        }
    }
}

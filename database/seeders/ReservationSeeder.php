<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\User;
use App\Models\PackageOption;
use App\Models\Lane;
use App\Models\OpeningTime;
use App\Models\ReservationStatus;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        // Fetch the first customer user
        $customer = User::whereHas('roles', function($query) {
            $query->where('name', 'customer');
        })->first();

        // Fetch some other data required for reservations (e.g., package options, lanes)
        $packageOption = PackageOption::first(); // assuming you have some package options already
        $lane = Lane::first(); // assuming you have lanes already
        $openingTime = OpeningTime::first(); // assuming you have opening times already
        $reservationStatus = ReservationStatus::first(); // assuming you have statuses already

        // Create a reservation entry
        Reservation::create([
            'person_id' => $customer->id, // Customer user ID
            'opening_time_id' => $openingTime->id,
            'lane_id' => $lane->id,
            'package_option_id' => $packageOption->id,
            'reservation_status_id' => $reservationStatus->id,
            'date' => Carbon::now()->addDays(1)->format('Y-m-d'),
            'start_time' => Carbon::now()->format('H:i'),
            'end_time' => Carbon::now()->addHour()->format('H:i'),
            'adult_count' => 2,
            'child_count' => 2,
            'is_active' => true,
        ]);
    }
}

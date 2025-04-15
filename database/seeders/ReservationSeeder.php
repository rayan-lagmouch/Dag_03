<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\Person;
use App\Models\OpeningTime;
use App\Models\Lane;
use App\Models\PackageOption;
use App\Models\ReservationStatus;
use App\Models\Game;
use App\Models\Score;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        // Zorg dat er minstens 2 personen zijn
        $person = Person::first() ?? Person::factory()->create();
        $secondPerson = Person::skip(1)->first() ?? Person::factory()->create();

        // Ophalen van gekoppelde modellen
        $openingTime = OpeningTime::first();
        $lane = Lane::first();
        $package = PackageOption::first();
        $status = ReservationStatus::find(2) ?? ReservationStatus::first(); // fallback

        // Aanmaken van een reservering
        $reservation = Reservation::create([
            'person_id' => $person->id,
            'opening_time_id' => $openingTime->id ?? 1,
            'lane_id' => $lane->id ?? 1,
            'package_option_id' => $package->id ?? 1,
            'reservation_status_id' => $status->id ?? 2,
            'date' => '2025-04-12',
            'start_time' => '14:00:00',
            'end_time' => '15:00:00',
            'adult_count' => 2,
            'child_count' => 1,
            'is_active' => true,
        ]);

        // Games aanmaken voor beide personen
        $game1 = Game::create([
            'reservation_id' => $reservation->id,
            'person_id' => $person->id,
            'game_count' => 1,
        ]);

        $game2 = Game::create([
            'reservation_id' => $reservation->id,
            'person_id' => $secondPerson->id,
            'game_count' => 1,
        ]);

        // Scores aan de games koppelen
        Score::create([
            'game_id' => $game1->id,
            'points' => 185,
        ]);

        Score::create([
            'game_id' => $game2->id,
            'points' => 212,
        ]);
    }
}

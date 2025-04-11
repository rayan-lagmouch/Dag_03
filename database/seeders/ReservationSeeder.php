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
        // Get actual IDs from seeded data
        $person = Person::first();
        $secondPerson = Person::skip(1)->first() ?? Person::factory()->create(); // Zorg voor 2 personen
        $openingTime = OpeningTime::first();
        $lane = Lane::first();
        $package = PackageOption::first();
        $status = ReservationStatus::find(2); // 2 = 'confirmed'

        $reservation = Reservation::create([
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

        $game1 = Game::create([
            'reservation_id' => $reservation->id,
            'person_id' => $person->id,
            'game_count' => 1, // <--- toegevoegd
        ]);
        
        $game2 = Game::create([
            'reservation_id' => $reservation->id,
            'person_id' => $secondPerson->id,
            'game_count' => 1, // <--- toegevoegd
        ]);
        

        // Scores koppelen aan de games
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

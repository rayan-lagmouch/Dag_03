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
        // Zorg dat er minstens 5 personen zijn
        $person1 = Person::first() ?? Person::factory()->create();
        $person2 = Person::skip(1)->first() ?? Person::factory()->create();
        $person3 = Person::skip(2)->first() ?? Person::factory()->create();
        $person4 = Person::skip(3)->first() ?? Person::factory()->create();
        $person5 = Person::skip(4)->first() ?? Person::factory()->create();

        $openingTime = OpeningTime::first();
        $package = PackageOption::first();
        $status = ReservationStatus::find(1) ?? ReservationStatus::first();

        // Reservering 1 - met kinderen
        $laneWithChildren = Lane::whereIn('number', [7, 8])->inRandomOrder()->first();

        $reservationWithKids = Reservation::create([
            'person_id' => $person1->id,
            'opening_time_id' => $openingTime->id ?? 1,
            'lane_id' => $laneWithChildren->id ?? 1,
            'package_option_id' => $package->id ?? 1,
            'reservation_status_id' => $status->id ?? 1,
            'date' => '2025-04-12',
            'start_time' => '14:00:00',
            'end_time' => '15:00:00',
            'adult_count' => 2,
            'child_count' => 1,
            'is_active' => true,
        ]);

        $game1 = Game::create([
            'reservation_id' => $reservationWithKids->id,
            'person_id' => $person1->id,
            'game_count' => 1,
        ]);
        $game2 = Game::create([
            'reservation_id' => $reservationWithKids->id,
            'person_id' => $person2->id,
            'game_count' => 1,
        ]);

        Score::create(['game_id' => $game1->id, 'points' => 290]);
        Score::create(['game_id' => $game2->id, 'points' => 300]);

        // Reservering 2
        $lane2 = Lane::whereNotIn('number', [7, 8])->inRandomOrder()->first();
        $reservation2 = Reservation::create([
            'person_id' => $person3->id,
            'opening_time_id' => $openingTime->id ?? 2,
            'lane_id' => $lane2->id ?? 2,
            'package_option_id' => 3,
            'reservation_status_id' => 1,
            'date' => '2025-04-13',
            'start_time' => '16:00:00',
            'end_time' => '18:00:00',
            'adult_count' => 4,
            'child_count' => 0,
            'is_active' => true,
        ]);
        $game3 = Game::create([
            'reservation_id' => $reservation2->id,
            'person_id' => $person3->id,
            'game_count' => 1,
        ]);
        Score::create(['game_id' => $game3->id, 'points' => 120]);

        // Reservering 3
        $lane3 = Lane::whereNotIn('number', [7, 8])->inRandomOrder()->first();
        $reservation3 = Reservation::create([
            'person_id' => $person4->id,
            'opening_time_id' => $openingTime->id ?? 3,
            'lane_id' => $lane3->id ?? 3,
            'package_option_id' => 4,
            'reservation_status_id' => 1,
            'date' => '2025-04-14',
            'start_time' => '14:00:00',
            'end_time' => '15:00:00',
            'adult_count' => 3,
            'child_count' => 0,
            'is_active' => true,
        ]);
        $game4 = Game::create([
            'reservation_id' => $reservation3->id,
            'person_id' => $person4->id,
            'game_count' => 1,
        ]);
        Score::create(['game_id' => $game4->id, 'points' => 34]);

        $game5 = Game::create([
            'reservation_id' => $reservation3->id,
            'person_id' => $person5->id,
            'game_count' => 1,
        ]);
        // Geen score voor game5 (bewust)

        // Reservering 4
       // Reservering 4 - zonder scores
// Reservering 4 - tweede reservering van Mazin (zonder scores)
$reservation4 = Reservation::create([
    'person_id' => $person1->id, // Mazin
    'opening_time_id' => $openingTime->id ?? 4,
    'lane_id' => $laneWithChildren->id,
    'package_option_id' => 4,
    'reservation_status_id' => 1,
    'date' => '2025-04-15',
    'start_time' => '19:00:00',
    'end_time' => '21:00:00',
    'adult_count' => 2,
    'child_count' => 0,
    'is_active' => true,
]);

$game6 = Game::create([
    'reservation_id' => $reservation4->id,
    'person_id' => $person1->id, // Mazin
    'game_count' => 1,
]);

$game7 = Game::create([
    'reservation_id' => $reservation4->id,
    'person_id' => $person2->id,
    'game_count' => 1,
]);



    }
}

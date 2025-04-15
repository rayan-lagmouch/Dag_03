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
        $status = ReservationStatus::find(2) ?? ReservationStatus::first();

        /**
         * Reservering 1 - met kinderen (baan 7 of 8)
         */
        $laneWithChildren = Lane::whereIn('number', [7, 8])->inRandomOrder()->first();

        $reservationWithKids = Reservation::create([
            'person_id' => $person1->id,
            'opening_time_id' => $openingTime->id ?? 1,
            'lane_id' => $laneWithChildren->id ?? 1,
            'package_option_id' => $package->id ?? 1,
            'reservation_status_id' => $status->id ?? 2,
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

        Score::create(['game_id' => $game1->id, 'points' => 185]);
        Score::create(['game_id' => $game2->id, 'points' => 212]);

        /**
         * Reservering 2 - zonder kinderen (baan NIET 7 of 8)
         */
        $laneWithoutChildren = Lane::whereNotIn('number', [7, 8])->inRandomOrder()->first();

        $reservationWithoutKids = Reservation::create([
            'person_id' => $person3->id,
            'opening_time_id' => $openingTime->id ?? 1,
            'lane_id' => $laneWithoutChildren->id ?? 2,
            'package_option_id' => $package->id ?? 1,
            'reservation_status_id' => $status->id ?? 2,
            'date' => '2025-04-13',
            'start_time' => '16:00:00',
            'end_time' => '17:00:00',
            'adult_count' => 3,
            'child_count' => 0,
            'is_active' => true,
        ]);

        $game3 = Game::create([
            'reservation_id' => $reservationWithoutKids->id,
            'person_id' => $person3->id,
            'game_count' => 1,
        ]);

        Score::create(['game_id' => $game3->id, 'points' => 198]);

        /**
         * Reservering 3 - zonder kinderen, andere persoon
         */
        $extraLane = Lane::whereNotIn('number', [7, 8])->inRandomOrder()->first();

        $reservationExtra = Reservation::create([
            'person_id' => $person4->id,
            'opening_time_id' => $openingTime->id ?? 1,
            'lane_id' => $extraLane->id ?? 3,
            'package_option_id' => $package->id ?? 1,
            'reservation_status_id' => $status->id ?? 2,
            'date' => '2025-04-14',
            'start_time' => '18:00:00',
            'end_time' => '19:00:00',
            'adult_count' => 2,
            'child_count' => 0,
            'is_active' => true,
        ]);

        $game4 = Game::create([
            'reservation_id' => $reservationExtra->id,
            'person_id' => $person4->id,
            'game_count' => 1,
        ]);

        Score::create(['game_id' => $game4->id, 'points' => 205]);

        /**
         * ✅ Reservering 4 - zonder scores
         */
        $noScoreLane = Lane::whereNotIn('number', [7, 8])->inRandomOrder()->first();

        $reservationNoScore = Reservation::create([
            'person_id' => $person5->id,
            'opening_time_id' => $openingTime->id ?? 1,
            'lane_id' => $noScoreLane->id ?? 4,
            'package_option_id' => $package->id ?? 1,
            'reservation_status_id' => $status->id ?? 2,
            'date' => '2025-04-15',
            'start_time' => '20:00:00',
            'end_time' => '21:00:00',
            'adult_count' => 1,
            'child_count' => 0,
            'is_active' => true,
        ]);

        Game::create([
            'reservation_id' => $reservationNoScore->id,
            'person_id' => $person5->id,
            'game_count' => 1,
        ]);

        // ❌ No score created here — on purpose
    }
}

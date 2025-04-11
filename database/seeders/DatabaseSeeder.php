<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PersonTypeSeeder::class,
            PersonSeeder::class,
            PackageOptionSeeder::class, // Make sure this is before ReservationSeeder
            LaneSeeder::class, // Make sure this is before ReservationSeeder
            OpeningTimeSeeder::class, // Make sure this is before ReservationSeeder
            ReservationStatusSeeder::class, // Make sure this is before ReservationSeeder
            ReservationSeeder::class, // ReservationSeeder should run last
        ]);
    }
}

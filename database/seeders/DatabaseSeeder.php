<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
<<<<<<< HEAD
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
=======
/**
* Seed the application's database.
*/
public function run(): void
{
$this->call([
LaneSeeder::class,
OpeningTimeSeeder::class,
PackageOptionSeeder::class,
PersonTypeSeeder::class,  // Ensure this runs before PersonSeeder
PersonSeeder::class,
ReservationStatusSeeder::class,
ReservationSeeder::class,
UserSeeder::class,
]);
}
>>>>>>> 86efda1a5dbad7b9eefd5d0c680def90586fa6f8
}

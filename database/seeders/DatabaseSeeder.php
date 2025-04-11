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
}

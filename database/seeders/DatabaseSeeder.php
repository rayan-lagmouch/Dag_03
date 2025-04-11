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
            ReservationStatusSeeder::class,
            PersonSeeder::class,
            PackageOptionSeeder::class,
            ReservationSeeder::class,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\PackageOption;
use Illuminate\Database\Seeder;

class PackageOptionSeeder extends Seeder
{
    public function run()
    {
        // Adding some example package options
        PackageOption::create(['name' => 'Standard', 'is_active' => true]);
        PackageOption::create(['name' => 'VIP', 'is_active' => true]);
        PackageOption::create(['name' => 'Bachelor Party', 'is_active' => true]);
    }
}

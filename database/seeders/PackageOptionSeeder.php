<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PackageOption;

class PackageOptionSeeder extends Seeder
{
    public function run()
    {
        PackageOption::create(['name' => 'snackpacketbasis']);
        PackageOption::create(['name' => 'snackpakketluxe']);
        PackageOption::create(['name' => 'kinderpartij']);
        PackageOption::create(['name' => 'vrijgezellenfeest']);
    }
}

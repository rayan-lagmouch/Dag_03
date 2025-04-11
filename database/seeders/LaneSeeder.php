<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lane;

class LaneSeeder extends Seeder
{
    public function run()
    {
        Lane::create(['number' => 7, 'has_fence' => true]);
        Lane::create(['number' => 8, 'has_fence' => false]);
    }
}


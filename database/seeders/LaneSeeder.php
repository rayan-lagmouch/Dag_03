<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lane;

class LaneSeeder extends Seeder
{
    public function run()
    {
        // Lanes with safety fences (1-7)
        Lane::create(['number' => 1, 'has_fence' => true]);
        Lane::create(['number' => 2, 'has_fence' => true]);
        Lane::create(['number' => 3, 'has_fence' => true]);
        Lane::create(['number' => 4, 'has_fence' => true]);
        Lane::create(['number' => 5, 'has_fence' => true]);
        Lane::create(['number' => 6, 'has_fence' => true]);
        Lane::create(['number' => 7, 'has_fence' => true]);

        // Lanes without safety fences (e.g., lane 8)
        Lane::create(['number' => 8, 'has_fence' => false]);
        // You can add more lanes without safety fences here, if needed
        // For example, you can add lanes 9, 10, etc., by changing the 'number' accordingly

        // More lanes if necessary, you can modify here as per your requirements
    }
}

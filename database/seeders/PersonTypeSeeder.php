<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PersonType;

class PersonTypeSeeder extends Seeder
{
    public function run()
    {
        PersonType::create([
            'name' => 'customer',
            'is_active' => true,
        ]);

        PersonType::create([
            'name' => 'employee',
            'is_active' => true,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PersonType;

class PersonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert default person types into person_types table
        PersonType::create([
            'name' => 'customer',
            'is_active' => true,
        ]);

        PersonType::create([
            'name' => 'employee',
            'is_active' => true,
        ]);

        // Add more types if needed
    }
}

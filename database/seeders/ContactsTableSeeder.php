<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;  // Use the correct singular model name

class ContactsTableSeeder extends Seeder
{
    public function run()
    {
        // Insert the contact details for each person in the persons table

        Contact::create([
            'person_id' => 1,  // Person ID linked to Mazin (customer)
            'mobile'    => '0612365478',
            'email'     => 'm.jamil@gmail.com',
        ]);

        Contact::create([
            'person_id' => 2,  // Person ID linked to Arjan (customer)
            'mobile'    => '0637264532',
            'email'     => 'a.ruijter@gmail.com',
        ]);

        Contact::create([
            'person_id' => 3,  // Person ID linked to Hans (customer)
            'mobile'    => '0639451238',
            'email'     => 'h.odijk@gmail.com',
        ]);

        Contact::create([
            'person_id' => 4,  // Person ID linked to Dennis (customer)
            'mobile'    => '0693234612',
            'email'     => 'd.van.wakeren@gmail.com',
        ]);

        Contact::create([
            'person_id' => 5,  // Person ID linked to Wilco (employee)
            'mobile'    => '0693234694',
            'email'     => 'w.van.de.grift@gmail.com',
        ]);
    }
}

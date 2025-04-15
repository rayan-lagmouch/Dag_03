<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactsTableSeeder extends Seeder
{
    public function run()
    {
        // Insert the provided data directly into the contacts table
        Contact::create([
            'person_id' => 1,  // Person ID linked to the first person
            'mobile'    => '0612365478',
            'email'     => 'm.jamil@gmail.com',
        ]);

        Contact::create([
            'person_id' => 2,  // Person ID linked to the second person
            'mobile'    => '0637264532',
            'email'     => 'a.ruijter@gmail.com',
        ]);

        Contact::create([
            'person_id' => 3,  // Person ID linked to the third person
            'mobile'    => '0639451238',
            'email'     => 'h.odijk@gmail.com',
        ]);

        Contact::create([
            'person_id' => 4,  // Person ID linked to the fourth person
            'mobile'    => '0693234612',
            'email'     => 'd.van.wakeren@gmail.com',
        ]);

        Contact::create([
            'person_id' => 5,  // Person ID linked to the fifth person
            'mobile'    => '0693234694',
            'email'     => 'w.van.de.grift@gmail.com',
        ]);
    }
}

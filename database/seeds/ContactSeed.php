<?php

use Illuminate\Database\Seeder;

class ContactSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'company_id' => 1, 'first_name' => 'contacts[1][first_name]', 'last_name' => 'contacts[1][last_name]', 'email' => 'example@example.com', 'skype' => 'contacts[1][skype]', 'address' => 'contacts[1][address]', 'notes' => null, 'created_by_id' => null, 'created_by_team_id' => null,],

        ];

        foreach ($items as $item) {
            \App\Contact::create($item);
        }
    }
}

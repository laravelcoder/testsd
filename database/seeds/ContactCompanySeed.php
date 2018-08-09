<?php

use Illuminate\Database\Seeder;

class ContactCompanySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Coke', 'address' => 'address', 'website' => 'website', 'email' => 'example@example.com', 'address2' => 'address2', 'city' => 'city', 'state' => 'state', 'zipcode' => '90210', 'country' => 'country', 'logo' => null, 'created_by_id' => 2, 'created_by_team_id' => null,],

        ];

        foreach ($items as $item) {
            \App\ContactCompany::create($item);
        }
    }
}

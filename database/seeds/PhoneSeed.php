<?php

use Illuminate\Database\Seeder;

class PhoneSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [

            ['id' => 4, 'phone_number' => '1234567890', 'contact_id' => null, 'advertiser_id' => 1, 'agent_id' => null],

        ];

        foreach ($items as $item) {
            \App\Phone::create($item);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class TeamSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [

            ['id' => 1, 'name' => 'Phillips Team'],

        ];

        foreach ($items as $item) {
            \App\Team::create($item);
        }
    }
}

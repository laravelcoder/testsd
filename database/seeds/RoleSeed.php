<?php

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [

            ['id' => 1, 'title' => 'Administrator (can create other users)'],
            ['id' => 3, 'title' => 'Developer'],
            ['id' => 4, 'title' => 'Dish Executive'],
            ['id' => 5, 'title' => 'Dish Sales'],
            ['id' => 6, 'title' => 'Ad Agency'],
            ['id' => 7, 'title' => 'Advertiser'],
            ['id' => 8, 'title' => 'Team Admin'],

        ];

        foreach ($items as $item) {
            \App\Role::create($item);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [

            ['id' => 2, 'name' => 'Phillip Madsen', 'email' => 'wecodelaravel@gmail.com', 'password' => '$2y$10$LnekUT.x39sS2XOA4V2JAOy9UI3J3/41c4520vjrAwHhdUjAD0/.2', 'remember_token' => null, 'team_id' => null],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}

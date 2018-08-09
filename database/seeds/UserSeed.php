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
            
            ['id' => 2, 'name' => 'Phillip Madsen', 'email' => 'wecodelaravel@gmail.com', 'password' => '$2y$10$LnekUT.x39sS2XOA4V2JAOy9UI3J3/41c4520vjrAwHhdUjAD0/.2', 'remember_token' => null, 'team_id' => null,],
            ['id' => 3, 'name' => 'Adam Harral', 'email' => 'adam.harral@sling.com', 'password' => '$2y$10$CtqaHtndcIe1YhK3/0ayduUfKHdgCtPbuCZOWBiX9GI1QsgYNWxzG', 'remember_token' => null, 'team_id' => null,],
            ['id' => 4, 'name' => 'Jorg Nonnenmacher ', 'email' => 'jorg.nonnenmacher@sling.com', 'password' => '$2y$10$bUZQ5Q6eYyZ6Y/RjoFIUhOOE2q/Wwk5yVbI1Dfr1UrhITOcE8XYDq', 'remember_token' => null, 'team_id' => null,],
            ['id' => 5, 'name' => 'Drew Major', 'email' => 'drew.major@sling.com', 'password' => '$2y$10$XBm/qy/wyWUTNFP15STE8.UPnxQa1TUTHF15ZwAgUT4QyIxCQhw6G', 'remember_token' => null, 'team_id' => null,],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}

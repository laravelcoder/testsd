<?php

use Illuminate\Database\Seeder;

class UserSeedPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            2 => [
                'role' => [1, 3, 4, 5, 6, 7],
            ],
            3 => [
                'role' => [3, 4, 5, 6, 7, 8],
            ],
            4 => [
                'role' => [3, 4, 5, 6, 7, 8],
            ],
            5 => [
                'role' => [3, 4, 5, 6, 7, 8],
            ],

        ];

        foreach ($items as $id => $item) {
            $user = \App\User::find($id);

            foreach ($item as $key => $ids) {
                $user->{$key}()->sync($ids);
            }
        }
    }
}

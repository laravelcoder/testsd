<?php

use Illuminate\Database\Seeder;

class CategorySeedPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [

            1 => [
                'advertiser_id' => [1],
                'ad_id'         => [],
            ],

        ];

        foreach ($items as $id => $item) {
            $category = \App\Category::find($id);

            foreach ($item as $key => $ids) {
                $category->{$key}()->sync($ids);
            }
        }
    }
}

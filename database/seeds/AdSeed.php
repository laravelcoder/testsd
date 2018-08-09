<?php

use Illuminate\Database\Seeder;

class AdSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [

            ['id' => 1, 'ad_label' => 'ads[1][ad_label]', 'ad_description' => null, 'video_upload' => null, 'total_impressions' => null, 'total_networks' => 1, 'total_channels' => 11, 'advertiser_id' => 1, 'created_by_id' => null, 'created_by_team_id' => null, 'video_screenshot' => null],

        ];

        foreach ($items as $item) {
            \App\Ad::create($item);
        }
    }
}

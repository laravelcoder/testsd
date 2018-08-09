<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateAd()
    {
        $admin = \App\User::find(1);
        $ad = factory('App\Ad')->make();

        $relations = [
            factory('App\Category')->create(),
            factory('App\Category')->create(),
        ];

        $this->browse(function (Browser $browser) use ($admin, $ad, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.ads.index'))
                ->clickLink('Add new')
                ->type('ad_label', $ad->ad_label)
                ->type('ad_description', $ad->ad_description)
                ->attach('video_upload', base_path('tests/_resources/test.jpg'))
                ->type('total_impressions', $ad->total_impressions)
                ->type('total_networks', $ad->total_networks)
                ->type('total_channels', $ad->total_channels)
                ->select('advertiser_id', $ad->advertiser_id)
                ->select('select[name="category_id[]"]', $relations[0]->id)
                ->select('select[name="category_id[]"]', $relations[1]->id)
                ->attach('video_screenshot', base_path('tests/_resources/test.jpg'))
                ->press('Save')
                ->assertRouteIs('admin.ads.index')
                ->assertSeeIn("tr:last-child td[field-key='ad_label']", $ad->ad_label)
                ->assertSeeIn("tr:last-child td[field-key='total_impressions']", $ad->total_impressions)
                ->assertSeeIn("tr:last-child td[field-key='total_networks']", $ad->total_networks)
                ->assertSeeIn("tr:last-child td[field-key='total_channels']", $ad->total_channels)
                ->assertSeeIn("tr:last-child td[field-key='advertiser']", $ad->advertiser->name)
                ->assertSeeIn("tr:last-child td[field-key='category_id'] span:first-child", $relations[0]->category)
                ->assertSeeIn("tr:last-child td[field-key='category_id'] span:last-child", $relations[1]->category)
                ->assertVisible("img[src='".env('APP_URL').'/'.env('UPLOAD_PATH').'/thumb/'.\App\Ad::first()->video_screenshot."']");
        });
    }

    public function testEditAd()
    {
        $admin = \App\User::find(1);
        $ad = factory('App\Ad')->create();
        $ad2 = factory('App\Ad')->make();

        $relations = [
            factory('App\Category')->create(),
            factory('App\Category')->create(),
        ];

        $this->browse(function (Browser $browser) use ($admin, $ad, $ad2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.ads.index'))
                ->click('tr[data-entry-id="'.$ad->id.'"] .btn-info')
                ->type('ad_label', $ad2->ad_label)
                ->type('ad_description', $ad2->ad_description)
                ->attach('video_upload', base_path('tests/_resources/test.jpg'))
                ->type('total_impressions', $ad2->total_impressions)
                ->type('total_networks', $ad2->total_networks)
                ->type('total_channels', $ad2->total_channels)
                ->select('advertiser_id', $ad2->advertiser_id)
                ->select('select[name="category_id[]"]', $relations[0]->id)
                ->select('select[name="category_id[]"]', $relations[1]->id)
                ->attach('video_screenshot', base_path('tests/_resources/test.jpg'))
                ->press('Update')
                ->assertRouteIs('admin.ads.index')
                ->assertSeeIn("tr:last-child td[field-key='ad_label']", $ad2->ad_label)
                ->assertSeeIn("tr:last-child td[field-key='total_impressions']", $ad2->total_impressions)
                ->assertSeeIn("tr:last-child td[field-key='total_networks']", $ad2->total_networks)
                ->assertSeeIn("tr:last-child td[field-key='total_channels']", $ad2->total_channels)
                ->assertSeeIn("tr:last-child td[field-key='advertiser']", $ad2->advertiser->name)
                ->assertSeeIn("tr:last-child td[field-key='category_id'] span:first-child", $relations[0]->category)
                ->assertSeeIn("tr:last-child td[field-key='category_id'] span:last-child", $relations[1]->category)
                ->assertVisible("img[src='".env('APP_URL').'/'.env('UPLOAD_PATH').'/thumb/'.\App\Ad::first()->video_screenshot."']");
        });
    }

    public function testShowAd()
    {
        $admin = \App\User::find(1);
        $ad = factory('App\Ad')->create();

        $relations = [
            factory('App\Category')->create(),
            factory('App\Category')->create(),
        ];

        $ad->category_id()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $ad, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.ads.index'))
                ->click('tr[data-entry-id="'.$ad->id.'"] .btn-primary')
                ->assertSeeIn("td[field-key='ad_label']", $ad->ad_label)
                ->assertSeeIn("td[field-key='ad_description']", $ad->ad_description)
                ->assertSeeIn("td[field-key='total_impressions']", $ad->total_impressions)
                ->assertSeeIn("td[field-key='total_networks']", $ad->total_networks)
                ->assertSeeIn("td[field-key='total_channels']", $ad->total_channels)
                ->assertSeeIn("td[field-key='advertiser']", $ad->advertiser->name)
                ->assertSeeIn("td[field-key='created_by']", $ad->created_by->name)
                ->assertSeeIn("td[field-key='created_by_team']", $ad->created_by_team->name)
                ->assertSeeIn("tr:last-child td[field-key='category_id'] span:first-child", $relations[0]->category)
                ->assertSeeIn("tr:last-child td[field-key='category_id'] span:last-child", $relations[1]->category);
        });
    }
}

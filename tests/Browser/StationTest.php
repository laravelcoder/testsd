<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class StationTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateStation()
    {
        $admin = \App\User::find(1);
        $station = factory('App\Station')->make();

        $this->browse(function (Browser $browser) use ($admin, $station) {
            $browser->loginAs($admin)
                ->visit(route('admin.stations.index'))
                ->clickLink('Add new')
                ->type('station_label', $station->station_label)
                ->type('channel_number', $station->channel_number)
                ->press('Save')
                ->assertRouteIs('admin.stations.index')
                ->assertSeeIn("tr:last-child td[field-key='station_label']", $station->station_label)
                ->assertSeeIn("tr:last-child td[field-key='channel_number']", $station->channel_number);
        });
    }

    public function testEditStation()
    {
        $admin = \App\User::find(1);
        $station = factory('App\Station')->create();
        $station2 = factory('App\Station')->make();

        $this->browse(function (Browser $browser) use ($admin, $station, $station2) {
            $browser->loginAs($admin)
                ->visit(route('admin.stations.index'))
                ->click('tr[data-entry-id="'.$station->id.'"] .btn-info')
                ->type('station_label', $station2->station_label)
                ->type('channel_number', $station2->channel_number)
                ->press('Update')
                ->assertRouteIs('admin.stations.index')
                ->assertSeeIn("tr:last-child td[field-key='station_label']", $station2->station_label)
                ->assertSeeIn("tr:last-child td[field-key='channel_number']", $station2->channel_number);
        });
    }

    public function testShowStation()
    {
        $admin = \App\User::find(1);
        $station = factory('App\Station')->create();

        $this->browse(function (Browser $browser) use ($admin, $station) {
            $browser->loginAs($admin)
                ->visit(route('admin.stations.index'))
                ->click('tr[data-entry-id="'.$station->id.'"] .btn-primary')
                ->assertSeeIn("td[field-key='station_label']", $station->station_label)
                ->assertSeeIn("td[field-key='channel_number']", $station->channel_number)
                ->assertSeeIn("td[field-key='created_by']", $station->created_by->name)
                ->assertSeeIn("td[field-key='created_by_team']", $station->created_by_team->name);
        });
    }
}

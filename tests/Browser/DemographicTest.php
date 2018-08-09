<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DemographicTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateDemographic()
    {
        $admin = \App\User::find(1);
        $demographic = factory('App\Demographic')->make();

        $this->browse(function (Browser $browser) use ($admin, $demographic) {
            $browser->loginAs($admin)
                ->visit(route('admin.demographics.index'))
                ->clickLink('Add new')
                ->type('demographic', $demographic->demographic)
                ->type('value', $demographic->value)
                ->select('advertiser_id', $demographic->advertiser_id)
                ->press('Save')
                ->assertRouteIs('admin.demographics.index')
                ->assertSeeIn("tr:last-child td[field-key='demographic']", $demographic->demographic)
                ->assertSeeIn("tr:last-child td[field-key='value']", $demographic->value)
                ->assertSeeIn("tr:last-child td[field-key='advertiser']", $demographic->advertiser->name);
        });
    }

    public function testEditDemographic()
    {
        $admin = \App\User::find(1);
        $demographic = factory('App\Demographic')->create();
        $demographic2 = factory('App\Demographic')->make();

        $this->browse(function (Browser $browser) use ($admin, $demographic, $demographic2) {
            $browser->loginAs($admin)
                ->visit(route('admin.demographics.index'))
                ->click('tr[data-entry-id="'.$demographic->id.'"] .btn-info')
                ->type('demographic', $demographic2->demographic)
                ->type('value', $demographic2->value)
                ->select('advertiser_id', $demographic2->advertiser_id)
                ->press('Update')
                ->assertRouteIs('admin.demographics.index')
                ->assertSeeIn("tr:last-child td[field-key='demographic']", $demographic2->demographic)
                ->assertSeeIn("tr:last-child td[field-key='value']", $demographic2->value)
                ->assertSeeIn("tr:last-child td[field-key='advertiser']", $demographic2->advertiser->name);
        });
    }

    public function testShowDemographic()
    {
        $admin = \App\User::find(1);
        $demographic = factory('App\Demographic')->create();

        $this->browse(function (Browser $browser) use ($admin, $demographic) {
            $browser->loginAs($admin)
                ->visit(route('admin.demographics.index'))
                ->click('tr[data-entry-id="'.$demographic->id.'"] .btn-primary')
                ->assertSeeIn("td[field-key='demographic']", $demographic->demographic)
                ->assertSeeIn("td[field-key='value']", $demographic->value)
                ->assertSeeIn("td[field-key='created_by']", $demographic->created_by->name)
                ->assertSeeIn("td[field-key='created_by_team']", $demographic->created_by_team->name)
                ->assertSeeIn("td[field-key='advertiser']", $demographic->advertiser->name);
        });
    }
}

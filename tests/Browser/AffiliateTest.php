<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AffiliateTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateAffiliate()
    {
        $admin = \App\User::find(1);
        $affiliate = factory('App\Affiliate')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $affiliate) {
            $browser->loginAs($admin)
                ->visit(route('admin.affiliates.index'))
                ->clickLink('Add new')
                ->type("affiliate", $affiliate->affiliate)
                ->press('Save')
                ->assertRouteIs('admin.affiliates.index')
                ->assertSeeIn("tr:last-child td[field-key='affiliate']", $affiliate->affiliate);
        });
    }

    public function testEditAffiliate()
    {
        $admin = \App\User::find(1);
        $affiliate = factory('App\Affiliate')->create();
        $affiliate2 = factory('App\Affiliate')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $affiliate, $affiliate2) {
            $browser->loginAs($admin)
                ->visit(route('admin.affiliates.index'))
                ->click('tr[data-entry-id="' . $affiliate->id . '"] .btn-info')
                ->type("affiliate", $affiliate2->affiliate)
                ->press('Update')
                ->assertRouteIs('admin.affiliates.index')
                ->assertSeeIn("tr:last-child td[field-key='affiliate']", $affiliate2->affiliate);
        });
    }

    public function testShowAffiliate()
    {
        $admin = \App\User::find(1);
        $affiliate = factory('App\Affiliate')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $affiliate) {
            $browser->loginAs($admin)
                ->visit(route('admin.affiliates.index'))
                ->click('tr[data-entry-id="' . $affiliate->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='affiliate']", $affiliate->affiliate);
        });
    }

}

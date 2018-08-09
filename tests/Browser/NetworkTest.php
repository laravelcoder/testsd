<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NetworkTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateNetwork()
    {
        $admin = \App\User::find(1);
        $network = factory('App\Network')->make();

        $this->browse(function (Browser $browser) use ($admin, $network) {
            $browser->loginAs($admin)
                ->visit(route('admin.networks.index'))
                ->clickLink('Add new')
                ->type('network', $network->network)
                ->type('network_affiliate', $network->network_affiliate)
                ->press('Save')
                ->assertRouteIs('admin.networks.index')
                ->assertSeeIn("tr:last-child td[field-key='network']", $network->network)
                ->assertSeeIn("tr:last-child td[field-key='network_affiliate']", $network->network_affiliate);
        });
    }

    public function testEditNetwork()
    {
        $admin = \App\User::find(1);
        $network = factory('App\Network')->create();
        $network2 = factory('App\Network')->make();

        $this->browse(function (Browser $browser) use ($admin, $network, $network2) {
            $browser->loginAs($admin)
                ->visit(route('admin.networks.index'))
                ->click('tr[data-entry-id="'.$network->id.'"] .btn-info')
                ->type('network', $network2->network)
                ->type('network_affiliate', $network2->network_affiliate)
                ->press('Update')
                ->assertRouteIs('admin.networks.index')
                ->assertSeeIn("tr:last-child td[field-key='network']", $network2->network)
                ->assertSeeIn("tr:last-child td[field-key='network_affiliate']", $network2->network_affiliate);
        });
    }

    public function testShowNetwork()
    {
        $admin = \App\User::find(1);
        $network = factory('App\Network')->create();

        $this->browse(function (Browser $browser) use ($admin, $network) {
            $browser->loginAs($admin)
                ->visit(route('admin.networks.index'))
                ->click('tr[data-entry-id="'.$network->id.'"] .btn-primary')
                ->assertSeeIn("td[field-key='network']", $network->network)
                ->assertSeeIn("td[field-key='network_affiliate']", $network->network_affiliate)
                ->assertSeeIn("td[field-key='created_by']", $network->created_by->name)
                ->assertSeeIn("td[field-key='created_by_team']", $network->created_by_team->name);
        });
    }
}

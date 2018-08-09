<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class NetworkTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateNetwork()
    {
        $admin = \App\User::find(1);
        $network = factory('App\Network')->make();

        $relations = [
            factory('App\Affiliate')->create(), 
            factory('App\Affiliate')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $network, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.networks.index'))
                ->clickLink('Add new')
                ->type("network", $network->network)
                ->type("network_id", $network->network_id)
                ->select('select[name="affiliates[]"]', $relations[0]->id)
                ->select('select[name="affiliates[]"]', $relations[1]->id)
                ->press('Save')
                ->assertRouteIs('admin.networks.index')
                ->assertSeeIn("tr:last-child td[field-key='network']", $network->network)
                ->assertSeeIn("tr:last-child td[field-key='network_id']", $network->network_id)
                ->assertSeeIn("tr:last-child td[field-key='affiliates'] span:first-child", $relations[0]->affiliate)
                ->assertSeeIn("tr:last-child td[field-key='affiliates'] span:last-child", $relations[1]->affiliate);
        });
    }

    public function testEditNetwork()
    {
        $admin = \App\User::find(1);
        $network = factory('App\Network')->create();
        $network2 = factory('App\Network')->make();

        $relations = [
            factory('App\Affiliate')->create(), 
            factory('App\Affiliate')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $network, $network2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.networks.index'))
                ->click('tr[data-entry-id="' . $network->id . '"] .btn-info')
                ->type("network", $network2->network)
                ->type("network_id", $network2->network_id)
                ->select('select[name="affiliates[]"]', $relations[0]->id)
                ->select('select[name="affiliates[]"]', $relations[1]->id)
                ->press('Update')
                ->assertRouteIs('admin.networks.index')
                ->assertSeeIn("tr:last-child td[field-key='network']", $network2->network)
                ->assertSeeIn("tr:last-child td[field-key='network_id']", $network2->network_id)
                ->assertSeeIn("tr:last-child td[field-key='affiliates'] span:first-child", $relations[0]->affiliate)
                ->assertSeeIn("tr:last-child td[field-key='affiliates'] span:last-child", $relations[1]->affiliate);
        });
    }

    public function testShowNetwork()
    {
        $admin = \App\User::find(1);
        $network = factory('App\Network')->create();

        $relations = [
            factory('App\Affiliate')->create(), 
            factory('App\Affiliate')->create(), 
        ];

        $network->affiliates()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $network, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.networks.index'))
                ->click('tr[data-entry-id="' . $network->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='network']", $network->network)
                ->assertSeeIn("td[field-key='created_by']", $network->created_by->name)
                ->assertSeeIn("td[field-key='created_by_team']", $network->created_by_team->name)
                ->assertSeeIn("td[field-key='network_id']", $network->network_id)
                ->assertSeeIn("tr:last-child td[field-key='affiliates'] span:first-child", $relations[0]->affiliate)
                ->assertSeeIn("tr:last-child td[field-key='affiliates'] span:last-child", $relations[1]->affiliate);
        });
    }

}

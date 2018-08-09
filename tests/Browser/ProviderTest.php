<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ProviderTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateProvider()
    {
        $admin = \App\User::find(1);
        $provider = factory('App\Provider')->make();

        $this->browse(function (Browser $browser) use ($admin, $provider) {
            $browser->loginAs($admin)
                ->visit(route('admin.providers.index'))
                ->clickLink('Add new')
                ->type('provider', $provider->provider)
                ->press('Save')
                ->assertRouteIs('admin.providers.index')
                ->assertSeeIn("tr:last-child td[field-key='provider']", $provider->provider);
        });
    }

    public function testEditProvider()
    {
        $admin = \App\User::find(1);
        $provider = factory('App\Provider')->create();
        $provider2 = factory('App\Provider')->make();

        $this->browse(function (Browser $browser) use ($admin, $provider, $provider2) {
            $browser->loginAs($admin)
                ->visit(route('admin.providers.index'))
                ->click('tr[data-entry-id="'.$provider->id.'"] .btn-info')
                ->type('provider', $provider2->provider)
                ->press('Update')
                ->assertRouteIs('admin.providers.index')
                ->assertSeeIn("tr:last-child td[field-key='provider']", $provider2->provider);
        });
    }

    public function testShowProvider()
    {
        $admin = \App\User::find(1);
        $provider = factory('App\Provider')->create();

        $this->browse(function (Browser $browser) use ($admin, $provider) {
            $browser->loginAs($admin)
                ->visit(route('admin.providers.index'))
                ->click('tr[data-entry-id="'.$provider->id.'"] .btn-primary')
                ->assertSeeIn("td[field-key='provider']", $provider->provider);
        });
    }
}

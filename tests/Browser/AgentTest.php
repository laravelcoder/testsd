<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AgentTest extends DuskTestCase
{

    public function testCreateAgent()
    {
        $admin = \App\User::find(1);
        $agent = factory('App\Agent')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $agent) {
            $browser->loginAs($admin)
                ->visit(route('admin.agents.index'))
                ->clickLink('Add new')
                ->select("advertiser_id", $agent->advertiser_id)
                ->type("first_name", $agent->first_name)
                ->type("last_name", $agent->last_name)
                ->type("email", $agent->email)
                ->type("skype", $agent->skype)
                ->type("address", $agent->address)
                ->attach("photo", base_path("tests/_resources/test.jpg"))
                ->type("about", $agent->about)
                ->type("notes", $agent->notes)
                ->press('Save')
                ->assertRouteIs('admin.agents.index')
                ->assertSeeIn("tr:last-child td[field-key='advertiser']", $agent->advertiser->name)
                ->assertSeeIn("tr:last-child td[field-key='first_name']", $agent->first_name)
                ->assertSeeIn("tr:last-child td[field-key='last_name']", $agent->last_name)
                ->assertSeeIn("tr:last-child td[field-key='email']", $agent->email)
                ->assertSeeIn("tr:last-child td[field-key='skype']", $agent->skype)
                ->logout();
        });
    }

    public function testEditAgent()
    {
        $admin = \App\User::find(1);
        $agent = factory('App\Agent')->create();
        $agent2 = factory('App\Agent')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $agent, $agent2) {
            $browser->loginAs($admin)
                ->visit(route('admin.agents.index'))
                ->click('tr[data-entry-id="' . $agent->id . '"] .btn-info')
                ->select("advertiser_id", $agent2->advertiser_id)
                ->type("first_name", $agent2->first_name)
                ->type("last_name", $agent2->last_name)
                ->type("email", $agent2->email)
                ->type("skype", $agent2->skype)
                ->type("address", $agent2->address)
                ->attach("photo", base_path("tests/_resources/test.jpg"))
                ->type("about", $agent2->about)
                ->type("notes", $agent2->notes)
                ->press('Update')
                ->assertRouteIs('admin.agents.index')
                ->assertSeeIn("tr:last-child td[field-key='advertiser']", $agent2->advertiser->name)
                ->assertSeeIn("tr:last-child td[field-key='first_name']", $agent2->first_name)
                ->assertSeeIn("tr:last-child td[field-key='last_name']", $agent2->last_name)
                ->assertSeeIn("tr:last-child td[field-key='email']", $agent2->email)
                ->assertSeeIn("tr:last-child td[field-key='skype']", $agent2->skype)
                ->logout();
        });
    }

    public function testShowAgent()
    {
        $admin = \App\User::find(1);
        $agent = factory('App\Agent')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $agent) {
            $browser->loginAs($admin)
                ->visit(route('admin.agents.index'))
                ->click('tr[data-entry-id="' . $agent->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='advertiser']", $agent->advertiser->name)
                ->assertSeeIn("td[field-key='first_name']", $agent->first_name)
                ->assertSeeIn("td[field-key='last_name']", $agent->last_name)
                ->assertSeeIn("td[field-key='email']", $agent->email)
                ->assertSeeIn("td[field-key='skype']", $agent->skype)
                ->assertSeeIn("td[field-key='address']", $agent->address)
                ->assertSeeIn("td[field-key='about']", $agent->about)
                ->assertSeeIn("td[field-key='created_by']", $agent->created_by->name)
                ->assertSeeIn("td[field-key='created_by_team']", $agent->created_by_team->name)
                ->assertSeeIn("td[field-key='notes']", $agent->notes)
                ->logout();
        });
    }

}

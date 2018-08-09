<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AgentTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateAgent()
    {
        $admin = \App\User::find(1);
        $agent = factory('App\Agent')->make();

        $relations = [
            factory('App\Contactcompany')->create(),
            factory('App\Contactcompany')->create(),
        ];

        $this->browse(function (Browser $browser) use ($admin, $agent, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.agents.index'))
                ->clickLink('Add new')
                ->type('first_name', $agent->first_name)
                ->type('last_name', $agent->last_name)
                ->type('email', $agent->email)
                ->type('skype', $agent->skype)
                ->type('address', $agent->address)
                ->attach('photo', base_path('tests/_resources/test.jpg'))
                ->type('about', $agent->about)
                ->select('select[name="advertisers_id[]"]', $relations[0]->id)
                ->select('select[name="advertisers_id[]"]', $relations[1]->id)
                ->type('notes', $agent->notes)
                ->press('Save')
                ->assertRouteIs('admin.agents.index')
                ->assertSeeIn("tr:last-child td[field-key='first_name']", $agent->first_name)
                ->assertSeeIn("tr:last-child td[field-key='last_name']", $agent->last_name)
                ->assertSeeIn("tr:last-child td[field-key='email']", $agent->email)
                ->assertSeeIn("tr:last-child td[field-key='skype']", $agent->skype)
                ->assertSeeIn("tr:last-child td[field-key='advertisers_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='advertisers_id'] span:last-child", $relations[1]->name);
        });
    }

    public function testEditAgent()
    {
        $admin = \App\User::find(1);
        $agent = factory('App\Agent')->create();
        $agent2 = factory('App\Agent')->make();

        $relations = [
            factory('App\Contactcompany')->create(),
            factory('App\Contactcompany')->create(),
        ];

        $this->browse(function (Browser $browser) use ($admin, $agent, $agent2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.agents.index'))
                ->click('tr[data-entry-id="'.$agent->id.'"] .btn-info')
                ->type('first_name', $agent2->first_name)
                ->type('last_name', $agent2->last_name)
                ->type('email', $agent2->email)
                ->type('skype', $agent2->skype)
                ->type('address', $agent2->address)
                ->attach('photo', base_path('tests/_resources/test.jpg'))
                ->type('about', $agent2->about)
                ->select('select[name="advertisers_id[]"]', $relations[0]->id)
                ->select('select[name="advertisers_id[]"]', $relations[1]->id)
                ->type('notes', $agent2->notes)
                ->press('Update')
                ->assertRouteIs('admin.agents.index')
                ->assertSeeIn("tr:last-child td[field-key='first_name']", $agent2->first_name)
                ->assertSeeIn("tr:last-child td[field-key='last_name']", $agent2->last_name)
                ->assertSeeIn("tr:last-child td[field-key='email']", $agent2->email)
                ->assertSeeIn("tr:last-child td[field-key='skype']", $agent2->skype)
                ->assertSeeIn("tr:last-child td[field-key='advertisers_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='advertisers_id'] span:last-child", $relations[1]->name);
        });
    }

    public function testShowAgent()
    {
        $admin = \App\User::find(1);
        $agent = factory('App\Agent')->create();

        $relations = [
            factory('App\Contactcompany')->create(),
            factory('App\Contactcompany')->create(),
        ];

        $agent->advertisers_id()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $agent, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.agents.index'))
                ->click('tr[data-entry-id="'.$agent->id.'"] .btn-primary')
                ->assertSeeIn("td[field-key='first_name']", $agent->first_name)
                ->assertSeeIn("td[field-key='last_name']", $agent->last_name)
                ->assertSeeIn("td[field-key='email']", $agent->email)
                ->assertSeeIn("td[field-key='skype']", $agent->skype)
                ->assertSeeIn("td[field-key='address']", $agent->address)
                ->assertSeeIn("td[field-key='about']", $agent->about)
                ->assertSeeIn("td[field-key='created_by']", $agent->created_by->name)
                ->assertSeeIn("td[field-key='created_by_team']", $agent->created_by_team->name)
                ->assertSeeIn("tr:last-child td[field-key='advertisers_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='advertisers_id'] span:last-child", $relations[1]->name)
                ->assertSeeIn("td[field-key='notes']", $agent->notes);
        });
    }
}

<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CampaignTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateCampaign()
    {
        $admin = \App\User::find(1);
        $campaign = factory('App\Campaign')->make();

        $this->browse(function (Browser $browser) use ($admin, $campaign) {
            $browser->loginAs($admin)
                ->visit(route('admin.campaigns.index'))
                ->clickLink('Add new')
                ->type('name', $campaign->name)
                ->type('start_date', $campaign->start_date)
                ->type('finish_date', $campaign->finish_date)
                ->press('Save')
                ->assertRouteIs('admin.campaigns.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $campaign->name)
                ->assertSeeIn("tr:last-child td[field-key='start_date']", $campaign->start_date)
                ->assertSeeIn("tr:last-child td[field-key='finish_date']", $campaign->finish_date);
        });
    }

    public function testEditCampaign()
    {
        $admin = \App\User::find(1);
        $campaign = factory('App\Campaign')->create();
        $campaign2 = factory('App\Campaign')->make();

        $this->browse(function (Browser $browser) use ($admin, $campaign, $campaign2) {
            $browser->loginAs($admin)
                ->visit(route('admin.campaigns.index'))
                ->click('tr[data-entry-id="'.$campaign->id.'"] .btn-info')
                ->type('name', $campaign2->name)
                ->type('start_date', $campaign2->start_date)
                ->type('finish_date', $campaign2->finish_date)
                ->press('Update')
                ->assertRouteIs('admin.campaigns.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $campaign2->name)
                ->assertSeeIn("tr:last-child td[field-key='start_date']", $campaign2->start_date)
                ->assertSeeIn("tr:last-child td[field-key='finish_date']", $campaign2->finish_date);
        });
    }

    public function testShowCampaign()
    {
        $admin = \App\User::find(1);
        $campaign = factory('App\Campaign')->create();

        $this->browse(function (Browser $browser) use ($admin, $campaign) {
            $browser->loginAs($admin)
                ->visit(route('admin.campaigns.index'))
                ->click('tr[data-entry-id="'.$campaign->id.'"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $campaign->name)
                ->assertSeeIn("td[field-key='start_date']", $campaign->start_date)
                ->assertSeeIn("td[field-key='finish_date']", $campaign->finish_date)
                ->assertSeeIn("td[field-key='created_by']", $campaign->created_by->name)
                ->assertSeeIn("td[field-key='created_by_team']", $campaign->created_by_team->name);
        });
    }
}

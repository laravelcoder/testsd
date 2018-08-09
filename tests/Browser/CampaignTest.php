<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CampaignTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateCampaign()
    {
        $admin = \App\User::find(1);
        $campaign = factory('App\Campaign')->make();

        $relations = [
            factory('App\Ad')->create(), 
            factory('App\Ad')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $campaign, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.campaigns.index'))
                ->clickLink('Add new')
                ->type("name", $campaign->name)
                ->type("start_date", $campaign->start_date)
                ->type("finish_date", $campaign->finish_date)
                ->select("advertiser_id", $campaign->advertiser_id)
                ->select('select[name="ads[]"]', $relations[0]->id)
                ->select('select[name="ads[]"]', $relations[1]->id)
                ->press('Save')
                ->assertRouteIs('admin.campaigns.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $campaign->name)
                ->assertSeeIn("tr:last-child td[field-key='start_date']", $campaign->start_date)
                ->assertSeeIn("tr:last-child td[field-key='finish_date']", $campaign->finish_date)
                ->assertSeeIn("tr:last-child td[field-key='ads'] span:first-child", $relations[0]->ad_label)
                ->assertSeeIn("tr:last-child td[field-key='ads'] span:last-child", $relations[1]->ad_label);
        });
    }

    public function testEditCampaign()
    {
        $admin = \App\User::find(1);
        $campaign = factory('App\Campaign')->create();
        $campaign2 = factory('App\Campaign')->make();

        $relations = [
            factory('App\Ad')->create(), 
            factory('App\Ad')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $campaign, $campaign2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.campaigns.index'))
                ->click('tr[data-entry-id="' . $campaign->id . '"] .btn-info')
                ->type("name", $campaign2->name)
                ->type("start_date", $campaign2->start_date)
                ->type("finish_date", $campaign2->finish_date)
                ->select("advertiser_id", $campaign2->advertiser_id)
                ->select('select[name="ads[]"]', $relations[0]->id)
                ->select('select[name="ads[]"]', $relations[1]->id)
                ->press('Update')
                ->assertRouteIs('admin.campaigns.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $campaign2->name)
                ->assertSeeIn("tr:last-child td[field-key='start_date']", $campaign2->start_date)
                ->assertSeeIn("tr:last-child td[field-key='finish_date']", $campaign2->finish_date)
                ->assertSeeIn("tr:last-child td[field-key='ads'] span:first-child", $relations[0]->ad_label)
                ->assertSeeIn("tr:last-child td[field-key='ads'] span:last-child", $relations[1]->ad_label);
        });
    }

    public function testShowCampaign()
    {
        $admin = \App\User::find(1);
        $campaign = factory('App\Campaign')->create();

        $relations = [
            factory('App\Ad')->create(), 
            factory('App\Ad')->create(), 
        ];

        $campaign->ads()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $campaign, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.campaigns.index'))
                ->click('tr[data-entry-id="' . $campaign->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $campaign->name)
                ->assertSeeIn("td[field-key='start_date']", $campaign->start_date)
                ->assertSeeIn("td[field-key='finish_date']", $campaign->finish_date)
                ->assertSeeIn("td[field-key='created_by']", $campaign->created_by->name)
                ->assertSeeIn("td[field-key='created_by_team']", $campaign->created_by_team->name)
                ->assertSeeIn("td[field-key='advertiser']", $campaign->advertiser->name)
                ->assertSeeIn("tr:last-child td[field-key='ads'] span:first-child", $relations[0]->ad_label)
                ->assertSeeIn("tr:last-child td[field-key='ads'] span:last-child", $relations[1]->ad_label);
        });
    }

}

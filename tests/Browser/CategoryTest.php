<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CategoryTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateCategory()
    {
        $admin = \App\User::find(1);
        $category = factory('App\Category')->make();

        $relations = [
            factory('App\Contactcompany')->create(),
            factory('App\Contactcompany')->create(),
            factory('App\Ad')->create(),
            factory('App\Ad')->create(),
        ];

        $this->browse(function (Browser $browser) use ($admin, $category, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.categories.index'))
                ->clickLink('Add new')
                ->type('category', $category->category)
                ->type('slug', $category->slug)
                ->select('select[name="advertiser_id[]"]', $relations[0]->id)
                ->select('select[name="advertiser_id[]"]', $relations[1]->id)
                ->select('select[name="ad_id[]"]', $relations[2]->id)
                ->select('select[name="ad_id[]"]', $relations[3]->id)
                ->press('Save')
                ->assertRouteIs('admin.categories.index')
                ->assertSeeIn("tr:last-child td[field-key='category']", $category->category)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $category->slug)
                ->assertSeeIn("tr:last-child td[field-key='advertiser_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='advertiser_id'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='ad_id'] span:first-child", $relations[2]->ad_label)
                ->assertSeeIn("tr:last-child td[field-key='ad_id'] span:last-child", $relations[3]->ad_label);
        });
    }

    public function testEditCategory()
    {
        $admin = \App\User::find(1);
        $category = factory('App\Category')->create();
        $category2 = factory('App\Category')->make();

        $relations = [
            factory('App\Contactcompany')->create(),
            factory('App\Contactcompany')->create(),
            factory('App\Ad')->create(),
            factory('App\Ad')->create(),
        ];

        $this->browse(function (Browser $browser) use ($admin, $category, $category2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.categories.index'))
                ->click('tr[data-entry-id="'.$category->id.'"] .btn-info')
                ->type('category', $category2->category)
                ->type('slug', $category2->slug)
                ->select('select[name="advertiser_id[]"]', $relations[0]->id)
                ->select('select[name="advertiser_id[]"]', $relations[1]->id)
                ->select('select[name="ad_id[]"]', $relations[2]->id)
                ->select('select[name="ad_id[]"]', $relations[3]->id)
                ->press('Update')
                ->assertRouteIs('admin.categories.index')
                ->assertSeeIn("tr:last-child td[field-key='category']", $category2->category)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $category2->slug)
                ->assertSeeIn("tr:last-child td[field-key='advertiser_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='advertiser_id'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='ad_id'] span:first-child", $relations[2]->ad_label)
                ->assertSeeIn("tr:last-child td[field-key='ad_id'] span:last-child", $relations[3]->ad_label);
        });
    }

    public function testShowCategory()
    {
        $admin = \App\User::find(1);
        $category = factory('App\Category')->create();

        $relations = [
            factory('App\Contactcompany')->create(),
            factory('App\Contactcompany')->create(),
            factory('App\Ad')->create(),
            factory('App\Ad')->create(),
        ];

        $category->advertiser_id()->attach([$relations[0]->id, $relations[1]->id]);
        $category->ad_id()->attach([$relations[2]->id, $relations[3]->id]);

        $this->browse(function (Browser $browser) use ($admin, $category, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.categories.index'))
                ->click('tr[data-entry-id="'.$category->id.'"] .btn-primary')
                ->assertSeeIn("td[field-key='category']", $category->category)
                ->assertSeeIn("td[field-key='slug']", $category->slug)
                ->assertSeeIn("tr:last-child td[field-key='advertiser_id'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='advertiser_id'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='ad_id'] span:first-child", $relations[2]->ad_label)
                ->assertSeeIn("tr:last-child td[field-key='ad_id'] span:last-child", $relations[3]->ad_label);
        });
    }
}

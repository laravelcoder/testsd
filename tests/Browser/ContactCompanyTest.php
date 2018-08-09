<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ContactCompanyTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateContactCompany()
    {
        $admin = \App\User::find(1);
        $contact_company = factory('App\ContactCompany')->make();

        $this->browse(function (Browser $browser) use ($admin, $contact_company) {
            $browser->loginAs($admin)
                ->visit(route('admin.contact_companies.index'))
                ->clickLink('Add new')
                ->type('name', $contact_company->name)
                ->type('address', $contact_company->address)
                ->type('website', $contact_company->website)
                ->type('email', $contact_company->email)
                ->type('address2', $contact_company->address2)
                ->type('city', $contact_company->city)
                ->type('state', $contact_company->state)
                ->type('zipcode', $contact_company->zipcode)
                ->type('country', $contact_company->country)
                ->attach('logo', base_path('tests/_resources/test.jpg'))
                ->press('Save')
                ->assertRouteIs('admin.contact_companies.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $contact_company->name)
                ->assertSeeIn("tr:last-child td[field-key='address']", $contact_company->address)
                ->assertSeeIn("tr:last-child td[field-key='website']", $contact_company->website)
                ->assertSeeIn("tr:last-child td[field-key='email']", $contact_company->email)
                ->assertSeeIn("tr:last-child td[field-key='address2']", $contact_company->address2)
                ->assertSeeIn("tr:last-child td[field-key='city']", $contact_company->city)
                ->assertSeeIn("tr:last-child td[field-key='state']", $contact_company->state)
                ->assertSeeIn("tr:last-child td[field-key='zipcode']", $contact_company->zipcode)
                ->assertSeeIn("tr:last-child td[field-key='country']", $contact_company->country)
                ->assertVisible("img[src='".env('APP_URL').'/'.env('UPLOAD_PATH').'/thumb/'.\App\ContactCompany::first()->logo."']");
        });
    }

    public function testEditContactCompany()
    {
        $admin = \App\User::find(1);
        $contact_company = factory('App\ContactCompany')->create();
        $contact_company2 = factory('App\ContactCompany')->make();

        $this->browse(function (Browser $browser) use ($admin, $contact_company, $contact_company2) {
            $browser->loginAs($admin)
                ->visit(route('admin.contact_companies.index'))
                ->click('tr[data-entry-id="'.$contact_company->id.'"] .btn-info')
                ->type('name', $contact_company2->name)
                ->type('address', $contact_company2->address)
                ->type('website', $contact_company2->website)
                ->type('email', $contact_company2->email)
                ->type('address2', $contact_company2->address2)
                ->type('city', $contact_company2->city)
                ->type('state', $contact_company2->state)
                ->type('zipcode', $contact_company2->zipcode)
                ->type('country', $contact_company2->country)
                ->attach('logo', base_path('tests/_resources/test.jpg'))
                ->press('Update')
                ->assertRouteIs('admin.contact_companies.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $contact_company2->name)
                ->assertSeeIn("tr:last-child td[field-key='address']", $contact_company2->address)
                ->assertSeeIn("tr:last-child td[field-key='website']", $contact_company2->website)
                ->assertSeeIn("tr:last-child td[field-key='email']", $contact_company2->email)
                ->assertSeeIn("tr:last-child td[field-key='address2']", $contact_company2->address2)
                ->assertSeeIn("tr:last-child td[field-key='city']", $contact_company2->city)
                ->assertSeeIn("tr:last-child td[field-key='state']", $contact_company2->state)
                ->assertSeeIn("tr:last-child td[field-key='zipcode']", $contact_company2->zipcode)
                ->assertSeeIn("tr:last-child td[field-key='country']", $contact_company2->country)
                ->assertVisible("img[src='".env('APP_URL').'/'.env('UPLOAD_PATH').'/thumb/'.\App\ContactCompany::first()->logo."']");
        });
    }

    public function testShowContactCompany()
    {
        $admin = \App\User::find(1);
        $contact_company = factory('App\ContactCompany')->create();

        $this->browse(function (Browser $browser) use ($admin, $contact_company) {
            $browser->loginAs($admin)
                ->visit(route('admin.contact_companies.index'))
                ->click('tr[data-entry-id="'.$contact_company->id.'"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $contact_company->name)
                ->assertSeeIn("td[field-key='address']", $contact_company->address)
                ->assertSeeIn("td[field-key='website']", $contact_company->website)
                ->assertSeeIn("td[field-key='email']", $contact_company->email)
                ->assertSeeIn("td[field-key='address2']", $contact_company->address2)
                ->assertSeeIn("td[field-key='city']", $contact_company->city)
                ->assertSeeIn("td[field-key='state']", $contact_company->state)
                ->assertSeeIn("td[field-key='zipcode']", $contact_company->zipcode)
                ->assertSeeIn("td[field-key='country']", $contact_company->country)
                ->assertSeeIn("td[field-key='created_by']", $contact_company->created_by->name)
                ->assertSeeIn("td[field-key='created_by_team']", $contact_company->created_by_team->name);
        });
    }
}

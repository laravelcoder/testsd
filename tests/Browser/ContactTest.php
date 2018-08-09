<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ContactTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateContact()
    {
        $admin = \App\User::find(1);
        $contact = factory('App\Contact')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $contact) {
            $browser->loginAs($admin)
                ->visit(route('admin.contacts.index'))
                ->clickLink('Add new')
                ->select("company_id", $contact->company_id)
                ->type("first_name", $contact->first_name)
                ->type("last_name", $contact->last_name)
                ->type("email", $contact->email)
                ->type("skype", $contact->skype)
                ->type("address", $contact->address)
                ->type("notes", $contact->notes)
                ->press('Save')
                ->assertRouteIs('admin.contacts.index')
                ->assertSeeIn("tr:last-child td[field-key='company']", $contact->company->name)
                ->assertSeeIn("tr:last-child td[field-key='first_name']", $contact->first_name)
                ->assertSeeIn("tr:last-child td[field-key='last_name']", $contact->last_name)
                ->assertSeeIn("tr:last-child td[field-key='email']", $contact->email);
        });
    }

    public function testEditContact()
    {
        $admin = \App\User::find(1);
        $contact = factory('App\Contact')->create();
        $contact2 = factory('App\Contact')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $contact, $contact2) {
            $browser->loginAs($admin)
                ->visit(route('admin.contacts.index'))
                ->click('tr[data-entry-id="' . $contact->id . '"] .btn-info')
                ->select("company_id", $contact2->company_id)
                ->type("first_name", $contact2->first_name)
                ->type("last_name", $contact2->last_name)
                ->type("email", $contact2->email)
                ->type("skype", $contact2->skype)
                ->type("address", $contact2->address)
                ->type("notes", $contact2->notes)
                ->press('Update')
                ->assertRouteIs('admin.contacts.index')
                ->assertSeeIn("tr:last-child td[field-key='company']", $contact2->company->name)
                ->assertSeeIn("tr:last-child td[field-key='first_name']", $contact2->first_name)
                ->assertSeeIn("tr:last-child td[field-key='last_name']", $contact2->last_name)
                ->assertSeeIn("tr:last-child td[field-key='email']", $contact2->email);
        });
    }

    public function testShowContact()
    {
        $admin = \App\User::find(1);
        $contact = factory('App\Contact')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $contact) {
            $browser->loginAs($admin)
                ->visit(route('admin.contacts.index'))
                ->click('tr[data-entry-id="' . $contact->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='company']", $contact->company->name)
                ->assertSeeIn("td[field-key='first_name']", $contact->first_name)
                ->assertSeeIn("td[field-key='last_name']", $contact->last_name)
                ->assertSeeIn("td[field-key='email']", $contact->email)
                ->assertSeeIn("td[field-key='skype']", $contact->skype)
                ->assertSeeIn("td[field-key='address']", $contact->address)
                ->assertSeeIn("td[field-key='notes']", $contact->notes)
                ->assertSeeIn("td[field-key='created_by']", $contact->created_by->name)
                ->assertSeeIn("td[field-key='created_by_team']", $contact->created_by_team->name);
        });
    }

}

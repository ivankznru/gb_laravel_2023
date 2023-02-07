<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class AdminCategoriesTest extends DuskTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
        //Seed the database
        $this->artisan('db:seed');

        //Login as admin user with id=1
        $user = User::find(1);
        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/home')
               ;
                
        });
    }

    /**
     * A Dusk test for categories.
     *
     * @return void
     */
    public function testFormErrorsOnAddEmptyCategory()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/categories/create')
                ->press('Add')
                ->assertSee('The Title field is required.');
        });
    }
    public function testFormErrorsOnAddCategoryWithShortTitle()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/categories/create')
                ->type('title', '1')
                ->press('Add')
                ->assertSee('The Title must be at least 3 characters.');
        });
    }
}

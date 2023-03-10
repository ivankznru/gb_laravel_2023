<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class AdminNewsTest extends DuskTestCase
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
     * A Dusk test for news.
     *
     * @return void
     */
    public function testFormErrorsOnAddEmptyNews()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/create')
                ->press('Add')
                ->assertSee('The Title field is required.')
                ->assertSee('The Text field is required.');
        });
    }
    public function testFormErrorsOnAddNewsWithShortTitleAndText()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/create')
                ->type('title', '1')
                ->type('text', '1')
                ->press('Add')
                ->assertSee('The Title must be at least 3 characters.')
                ->assertSee('The Text must be at least 3 characters.');
        });
    }
}

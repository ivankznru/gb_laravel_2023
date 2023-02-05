<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminCategoriesTest extends DuskTestCase
{
    //use RefreshDatabase;
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

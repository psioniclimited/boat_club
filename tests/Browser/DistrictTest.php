<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Organization\Entities\District;
use Modules\User\Entities\User;

class DistrictTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Laravel');
        });
    }

    /**
     * @return [type] [district]
     * @group district
     */
    public function testDistrictCreateForm()
    {
        $category = factory(District::class)->make();
        $this->browse(function (Browser $browser) use ($category) {
            $browser->loginAs(User::where('name', 'admin')->first()->id)
            ->visit('/organization/category')
            ->type('name', $category->name)
            ->type('description', $category->description);
            $browser->press('Submit');
        });

        $this->assertDatabaseHas('categories', ['name' => $category->name]);
    }
}

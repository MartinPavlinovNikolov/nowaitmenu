<?php

namespace Tests\Feature\admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Admin;

class AdminTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @test
     */
    public function admin_can_see_the_number_of_all_employers_in_dashboard()
    {
        $admin = factory(\App\Admin::class)->create();

        factory(\App\Employer::class, 20)->create()->each(function($employer) {
            $employer->admins()->attach(Admin::find(1));
        });

        $this->actingAs($admin, 'admin')
                ->get(route('admin.dashboard'))
                ->assertSee('showing from 1-10 of 20');
    }

    /**
     * @test
     */
    public function admin_can_get__corect_structure_of_the_table()
    {
        $admin = factory(\App\Admin::class)->create();

        $this->actingAs($admin, 'admin')
                ->get(route('admin.dashboard'))
                ->assertSee('ID')
                ->assertSee('Company name')
                ->assertSee('E-mail')
                ->assertSee('Date created')
                ->assertSee('Employees')
                ->assertSee('Status')
                ->assertSee('Last Login')
                ->assertSee('Actions');
    }

    /**
     * @test
     */
    public function admin_can_get_dashboard()
    {
        $admin = factory(\App\Admin::class)->create();

        $this->actingAs($admin, 'admin')
                ->assertAuthenticated('admin')
                ->get(route('admin.dashboard'))
                ->assertStatus(200);
    }

}

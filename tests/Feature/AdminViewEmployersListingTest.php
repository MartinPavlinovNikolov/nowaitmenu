<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

class AdminViewEmployersListingTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function admin_can_see_employers_listing()
    {
        $admin    = factory(\App\Admin::class)->create();
        $employer = factory(\App\Employer::class)->create([
            'name'       => 'John',
            'email'      => 'john@example.com',
            'status'     => true,
            'last_login' => Carbon::parse('December 13, 2018')
        ]);
        factory(\App\Employee::class)->create(['employer_id' => $employer->id]);


        $this->actingAs($admin, 'admin')
                ->get(route('admin.employers.index'))
                ->assertStatus(200)
                ->assertSee('ID')
                ->assertSee('Name')
                ->assertSee('Email')
                ->assertSee('Date Created')
                ->assertSee('Employees')
                ->assertSee('Status')
                ->assertSee('Last Login')
                ->assertSee('Actions')
                ->assertSee('1')
                ->assertSee('John')
                ->assertSee('john@example.com')
                ->assertSee('2018/13/12')
                ->assertSee('View(1)')
                ->assertSee('Active')
                ->assertSee('Disabled')
                ->assertSee('-')
                ->assertSee('Suspend')
                ->assertSee('Delete')
                ->assertSee('Login')
                ->assertSee('View All')
                ->assertSee('Search')
                ->assertSee('find by name')
                ->assertSee('find by email');
    }
    
    /** @test */
    public function admin_see_mesage_Nothing_Found()
    {
        $admin    = factory(\App\Admin::class)->create();
        
        $this->actingAs($admin, 'admin')
                ->get(route('admin.employers.index'))
                ->assertSessionHas('mesage', 'Nothing Found');
    }

    /** @test */
    public function guest_cant_see_employers_listing()
    {
        $this->get(route('admin.employers.index'))
                ->assertStatus(302);
    }

    /** @test */
    public function employer_cant_see_employers_listing()
    {
        $employer = factory(\App\Employer::class)->create();

        $this->actingAs($employer, 'employer')
                ->get(route('admin.employers.index'))
                ->assertStatus(302);
    }

    /** @test */
    public function employee_cant_see_employers_listing()
    {
        $employee = factory(\App\Employee::class)->create();

        $this->actingAs($employee, 'employee')
                ->get(route('admin.employers.index'))
                ->assertStatus(302);
    }

    /** @test */
    public function tablet_cant_see_employers_listing()
    {
        $tablet = factory(\App\Tablet::class)->create();

        $this->actingAs($tablet, 'tablet')
                ->get(route('admin.employers.index'))
                ->assertStatus(302);
    }

}

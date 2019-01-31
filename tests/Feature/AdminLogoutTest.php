<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminLogoutTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function guest_cant_access_this_route()
    {
        $this->put(route('admin.logout'))
                ->assertRedirect('/');
    }
    
    /** @test */
    public function employer_cant_access_this_route()
    {
        $employer = factory(\App\Employer::class)->create();
        $this->actingAs($employer, 'employer')
                ->put(route('admin.logout'))
                ->assertRedirect('/');
    }
    
    /** @test */
    public function employee_cant_access_this_route()
    {
        $employee = factory(\App\Employee::class)->create();
        $this->actingAs($employee, 'employee')
                ->put(route('admin.logout'))
                ->assertRedirect('/');
    }
    
    /** @test */
    public function tablet_cant_access_this_route()
    {
        $tablet = factory(\App\Tablet::class)->create();
        $this->actingAs($tablet, 'tablet')
                ->put(route('admin.logout'))
                ->assertRedirect('/');
    }
    
    /** @test */
    public function admin_can_log_out()
    {
        $admin = factory(\App\Admin::class)->create();
        $this->actingAs($admin, 'admin')
                ->put(route('admin.logout'));
        $this->assertGuest('admin');
    }
    
    /** @test */
    public function admin_will_be_redirected_to_marketing_page()
    {
        $admin = factory(\App\Admin::class)->create();
        $this->actingAs($admin, 'admin')
                ->put(route('admin.logout'))
                ->assertRedirect('/');
    }
}

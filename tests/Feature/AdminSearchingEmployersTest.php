<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminSearchingEmployersTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function admin_can_see_all_active_employers()
    {

        $admin = factory(\App\Admin::class)->create();
        factory(\App\Employer::class)->states('active')->create([
            'name'   => 'companyName'
        ]);

        $this->actingAs($admin, 'admin')
                ->get(route('admin.employers.active'))
                ->assertSee('companyName');
    }
    
    /** @test */
    public function admin_see_message_Nothing_Found_for_Active_employers()
    {
        $this->withoutExceptionHandling();
        $admin = factory(\App\Admin::class)->create();

        $this->actingAs($admin, 'admin')
                ->get(route('admin.employers.active'))
                ->assertSessionHas('mesage', 'Nothing Found');
    }
    
    /** @test */
    public function admin_see_message_Nothing_Found_for_Disabled_employers()
    {
        $this->withoutExceptionHandling();
        $admin = factory(\App\Admin::class)->create();

        $this->actingAs($admin, 'admin')
                ->get(route('admin.employers.disabled'))
                ->assertSessionHas('mesage', 'Nothing Found');
    }

    /** @test */
    public function admin_can_see_all_disabled_employers()
    {
        $admin = factory(\App\Admin::class)->create();
        factory(\App\Employer::class)->states('disabled')->create([
            'name'   => 'companyName'
        ]);

        $this->actingAs($admin, 'admin')
                ->get(route('admin.employers.disabled'))
                ->assertSee('companyName');
    }

    /** @test */
    public function admin_can_surch_for_employers_by_name()
    {

        $admin = factory(\App\Admin::class)->create();
        factory(\App\Employer::class)->create(['name' => 'company1']);
        factory(\App\Employer::class)->create(['name' => 'company2']);

        $this->actingAs($admin, 'admin')
                ->get(route('admin.employers.by.name.show', 'company'))
                ->assertSee('company1')
                ->assertSee('company2');
    }
    
    /** @test */
    public function admin_see_message_Nothing_Found_for_employers_by_name()
    {
        $this->withoutExceptionHandling();
        $admin = factory(\App\Admin::class)->create();

        $this->actingAs($admin, 'admin')
                ->get(route('admin.employers.by.name.show', 'company'))
                ->assertSessionHas('mesage', 'Nothing Found');
    }

    /** @test */
    public function admin_can_surch_for_employers_by_email()
    {

        $admin = factory(\App\Admin::class)->create();
        factory(\App\Employer::class)->create(['email' => 'some@example.com']);
        factory(\App\Employer::class)->create(['email' => 'another@example.com']);

        $this->actingAs($admin, 'admin')
                ->get(route('admin.employers.by.email.show', 'example'))
                ->assertSee('some@example.com')
                ->assertSee('another@example.com');
    }
    
    /** @test */
    public function admin_see_message_Nothing_Found_for_employers_by_email()
    {
        $this->withoutExceptionHandling();
        $admin = factory(\App\Admin::class)->create();

        $this->actingAs($admin, 'admin')
                ->get(route('admin.employers.by.name.show', 'company'))
                ->assertSessionHas('mesage', 'Nothing Found');
    }

    /** @test */
    public function guest_cant_search_by_name()
    {
        $this->get(route('admin.employers.by.name.show', 'some name'))
                ->assertStatus(302)
                ->assertRedirect(route('admin.login.form'));
    }

    /** @test */
    public function guest_cant_search_by_email()
    {
        $this->get(route('admin.employers.by.email.show', 'some email'))
                ->assertStatus(302)
                ->assertRedirect(route('admin.login.form'));
    }

    /** @test */
    public function guest_cant_get_disabled_employers()
    {
        $this->get(route('admin.employers.disabled'))
                ->assertStatus(302)
                ->assertRedirect(route('admin.login.form'));
    }

    /** @test */
    public function guest_cant_get_active_employers()
    {
        $this->get(route('admin.employers.active'))
                ->assertStatus(302)
                ->assertRedirect(route('admin.login.form'));
    }

    /** @test */
    public function employer_cant_search_by_name()
    {
        $employer = factory(\App\Employer::class)->create();

        $this->actingAs($employer, 'employer')
                ->assertAuthenticated('employer')
                ->get(route('admin.employers.by.name.show', 'some name'))
                ->assertStatus(302)
                ->assertRedirect(route('admin.login.form'));
    }

    /** @test */
    public function employer_cant_search_by_email()
    {
        $employer = factory(\App\Employer::class)->create();

        $this->actingAs($employer, 'employer')
                ->assertAuthenticated('employer')
                ->get(route('admin.employers.by.email.show', 'some email'))
                ->assertStatus(302)
                ->assertRedirect(route('admin.login.form'));
    }

    /** @test */
    public function employer_cant_get_disabled_employers()
    {
        $employer = factory(\App\Employer::class)->create();

        $this->actingAs($employer, 'employer')
                ->assertAuthenticated('employer')
                ->get(route('admin.employers.disabled'))
                ->assertStatus(302)
                ->assertRedirect(route('admin.login.form'));
    }

    /** @test */
    public function employer_cant_get_active_employers()
    {
        $employer = factory(\App\Employer::class)->create();

        $this->actingAs($employer, 'employer')
                ->assertAuthenticated('employer')
                ->get(route('admin.employers.active'))
                ->assertStatus(302)
                ->assertRedirect(route('admin.login.form'));
    }

    /** @test */
    public function employee_cant_search_by_name()
    {
        $employee = factory(\App\Employee::class)->create();

        $this->actingAs($employee, 'employee')
                ->assertAuthenticated('employee')
                ->get(route('admin.employers.by.name.show', 'some name'))
                ->assertStatus(302)
                ->assertRedirect(route('admin.login.form'));
    }

    /** @test */
    public function employee_cant_search_by_email()
    {
        $employee = factory(\App\Employee::class)->create();

        $this->actingAs($employee, 'employee')
                ->assertAuthenticated('employee')
                ->get(route('admin.employers.by.email.show', 'some email'))
                ->assertStatus(302)
                ->assertRedirect(route('admin.login.form'));
    }

    /** @test */
    public function employee_cant_get_disabled_employers()
    {
        $employee = factory(\App\Employee::class)->create();

        $this->actingAs($employee, 'employee')
                ->assertAuthenticated('employee')
                ->get(route('admin.employers.disabled'))
                ->assertStatus(302)
                ->assertRedirect(route('admin.login.form'));
    }

    /** @test */
    public function employee_cant_get_active_employers()
    {
        $employee = factory(\App\Employee::class)->create();

        $this->actingAs($employee, 'employee')
                ->assertAuthenticated('employee')
                ->get(route('admin.employers.active'))
                ->assertStatus(302)
                ->assertRedirect(route('admin.login.form'));
    }

    /** @test */
    public function tablet_cant_search_by_name()
    {
        $tablet = factory(\App\Tablet::class)->create();

        $this->actingAs($tablet, 'tablet')
                ->assertAuthenticated('tablet')
                ->get(route('admin.employers.by.name.show', 'some name'))
                ->assertStatus(302)
                ->assertRedirect(route('admin.login.form'));
    }

    /** @test */
    public function tablet_cant_search_by_email()
    {
        $tablet = factory(\App\Tablet::class)->create();

        $this->actingAs($tablet, 'tablet')
                ->assertAuthenticated('tablet')
                ->get(route('admin.employers.by.email.show', 'some email'))
                ->assertStatus(302)
                ->assertRedirect(route('admin.login.form'));
    }

    /** @test */
    public function tablet_cant_get_disabled_employers()
    {
        $tablet = factory(\App\Tablet::class)->create();

        $this->actingAs($tablet, 'tablet')
                ->assertAuthenticated('tablet')
                ->get(route('admin.employers.disabled'))
                ->assertStatus(302)
                ->assertRedirect(route('admin.login.form'));
    }

    /** @test */
    public function tablet_cant_get_active_employers()
    {
        $tablet = factory(\App\Tablet::class)->create();

        $this->actingAs($tablet, 'tablet')
                ->assertAuthenticated('tablet')
                ->get(route('admin.employers.active'))
                ->assertStatus(302)
                ->assertRedirect(route('admin.login.form'));
    }

}

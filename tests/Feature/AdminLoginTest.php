<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class AdminLoginTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function guest_can_get_form_for_admin()
    {

        $this->get(route('admin.login.form'))
                ->assertSee('Name')
                ->assertSee('Password');
    }

    /** @test */
    public function guest_can_login_as_admin()
    {
        $admin = factory(\App\Admin::class)->create([
            'name' => 'marto',
            'password' => 'qwerty'
        ]);

        $this->get(route('admin.login.submit'))
                ->assertSee('Name');
    }

    /** @test */
    public function redirect_to_admin_home_page_if_is_admin()
    {
        $admin = factory(\App\Admin::class)->create();

        $this->actingAs($admin, 'admin')
                ->get(route('admin.login.form'))
                ->assertStatus(302)
                ->assertRedirect(route('admin.employers.index'));
    }

    /** @test */
    public function employer_cant_get_form_for_admin()
    {
        $employer = factory(\App\Employer::class)->create();

        $this->actingAs($employer, 'employer')
                ->get(route('admin.login.form'))
                ->assertStatus(302)
                ->assertRedirect(route('employer.home'));
    }

    /** @test */
    public function employee_cant_get_form_for_admin()
    {
        $employee = factory(\App\Employee::class)->create();

        $this->actingAs($employee, 'employee')
                ->get(route('admin.login.form'))
                ->assertStatus(302);
    }

    /** @test */
    public function tablet_cant_get_form_for_admin()
    {
        $tablet = factory(\App\Tablet::class)->create();

        $this->actingAs($tablet, 'tablet')
                ->get(route('admin.login.form'))
                ->assertStatus(302);
    }

    /** @test */
    public function guest_can_be_login_as_admin()
    {
        factory(\App\Admin::class)->create([
            'name'           => 'admin_name',
            'password'       => Hash::make('qwerty'),
            'remember_token' => 'qwertyuiop'
        ]);

        $this->post(route('admin.login.submit'), [
                    'name'     => 'admin_name',
                    'password' => 'qwerty',
                ])
                ->assertStatus(302)
                ->assertRedirect(route('admin.employers.index'));
    }

    /** @test */
    public function employer_cant_submit_to_login()
    {
        $employer = factory(\App\Employer::class)->create();

        $this->actingAs($employer, 'employer')
                ->post(route('admin.login.submit'))
                ->assertStatus(302)
                ->assertRedirect(route('employer.home'));
    }

    /** @test */
    public function employee_cant_submit_to_login()
    {
        $employee = factory(\App\Employee::class)->create();

        $this->actingAs($employee, 'employee')
                ->post(route('admin.login.submit'))
                ->assertStatus(302);
    }

    /** @test */
    public function tablet_cant_submit_to_login()
    {
        $tablet = factory(\App\Tablet::class)->create();

        $this->actingAs($tablet, 'tablet')
                ->post(route('admin.login.submit'))
                ->assertStatus(302);
    }

    /** @test */
    public function name_is_required()
    {
        factory(\App\Admin::class)->create([
            'name'     => 'example name',
            'password' => Hash::make('qwerty')
        ]);

        $this->post(route('admin.login.submit'), [
                    'password' => 'qwerty'
                ])
                ->assertStatus(302)
                ->assertSessionHasErrors('name');
    }

    /** @test */
    public function name_must_be_min_2_characters()
    {
        factory(\App\Admin::class)->create([
            'name'     => 'example name',
            'password' => Hash::make('qwerty')
        ]);

        $this->post(route('admin.login.submit'), [
                    'name'     => 'e',
                    'password' => 'qwerty'
                ])
                ->assertStatus(302)
                ->assertSessionHasErrors('name');
    }

    /** @test */
    public function name_must_be_max_255_characters()
    {
        factory(\App\Admin::class)->create([
            'name'     => str_repeat('a', 255),
            'password' => Hash::make('qwerty')
        ]);

        $this->post(route('admin.login.submit'), [
                    'name'     => str_repeat('a', 256),
                    'password' => 'qwerty'
                ])
                ->assertStatus(302)
                ->assertSessionHasErrors('name');
    }

    /** @test */
    public function password_is_required()
    {
        factory(\App\Admin::class)->create([
            'name'     => 'example name',
            'password' => Hash::make('qwerty')
        ]);

        $this->post(route('admin.login.submit'), [
                    'name' => 'example name'
                ])
                ->assertStatus(302)
                ->assertSessionHasErrors('password');
    }

    /** @test */
    public function password_must_be_min_6_characters()
    {
        factory(\App\Admin::class)->create([
            'name'     => 'example name',
            'password' => Hash::make('qwerty')
        ]);

        $this->post(route('admin.login.submit'), [
                    'name'     => 'example name',
                    'password' => 'qwert'
                ])
                ->assertStatus(302)
                ->assertSessionHasErrors('password');
    }

}

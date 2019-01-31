<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class AdminSettingsTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function admin_can_see_correct_form_for_settings()
    {
        $admin = factory(\App\Admin::class)->create();

        $this->actingAs($admin, 'admin')
                ->get(route('admin.settings.edit', $admin->id))
                ->assertStatus(200)
                ->assertSee('password')
                ->assertSee('current_password')
                ->assertSee('password_confirmation');
    }

    /** @test */
    public function admin_can_change_his_password()
    {
        $admin           = factory(\App\Admin::class)->create(['password' => Hash::make('qwerty')]);
        $currentPassword = $admin->password;

        $this->actingAs($admin, 'admin')
                ->assertAuthenticated('admin')
                ->put(route('admin.settings.update', $admin->id), [
                    '_method'               => 'PUT',
                    'current_password'      => 'qwerty',
                    'password'              => 'qwertyNew',
                    'password_confirmation' => 'qwertyNew'
                ])
                ->assertStatus(200);
        
        $newAdminsPassword = \App\Admin::find(1)->password;

        $this->assertNotEquals($currentPassword, $newAdminsPassword);
    }

    /** @test */
    public function guest_cant_access_this_route()
    {
        $this->get(route('admin.settings.edit', rand(1, 9)))
                ->assertStatus(302)
                ->assertRedirect(route('admin.login.form'));
    }

    /** @test */
    public function employer_cant_access_this_route()
    {
        $employer = factory(\App\Employer::class)->create();

        $this->actingAs($employer, 'employer')
                ->assertAuthenticated('employer')
                ->get(route('admin.settings.edit', rand(1, 9)))
                ->assertStatus(302)
                ->assertRedirect(route('admin.login.form'));
    }

    /** @test */
    public function employee_cant_access_this_route()
    {
        $employee = factory(\App\Employee::class)->create();

        $this->actingAs($employee, 'employee')
                ->assertAuthenticated('employee')
                ->get(route('admin.settings.edit', rand(1, 9)))
                ->assertStatus(302)
                ->assertRedirect(route('admin.login.form'));
    }

    /** @test */
    public function tablet_cant_access_this_route()
    {
        $tablet = factory(\App\Tablet::class)->create();

        $this->actingAs($tablet, 'tablet')
                ->assertAuthenticated('tablet')
                ->get(route('admin.settings.edit', rand(1, 9)))
                ->assertStatus(302)
                ->assertRedirect(route('admin.login.form'));
    }

    /** @test */
    public function current_password_is_required()
    {
        $admin = factory(\App\Admin::class)->create(['password' => Hash::make('qwerty')]);

        $this->actingAs($admin, 'admin')
                ->put(route('admin.settings.update', $admin->id), [
                    '_method'               => 'PUT',
                    'password'              => 'qwertyNew',
                    'password_confirmation' => 'qwertyNew'
                ])
                ->assertStatus(302)
                ->assertSessionHasErrors('current_password');
    }

    /** @test */
    public function current_password_must_be_at_least_6_characters()
    {
        $admin = factory(\App\Admin::class)->create(['password' => Hash::make('qwerty')]);

        $this->actingAs($admin, 'admin')
                ->put(route('admin.settings.update', $admin->id), [
                    '_method'               => 'PUT',
                    'current_password'      => 'qwert',
                    'password'              => 'qwertyNew',
                    'password_confirmation' => 'qwertyNew'
                ])
                ->assertStatus(302)
                ->assertSessionHasErrors('current_password');
    }

    /** @test */
    public function password_is_required()
    {
        $admin = factory(\App\Admin::class)->create(['password' => Hash::make('qwerty')]);

        $this->actingAs($admin, 'admin')
                ->put(route('admin.settings.update', $admin->id), [
                    '_method'               => 'PUT',
                    'current_password'      => 'qwerty',
                    'password_confirmation' => 'qwertyNew'
                ])
                ->assertStatus(302)
                ->assertSessionHasErrors('password');
    }

    /** @test */
    public function password_must_be_at_least_6_characters()
    {
        $admin = factory(\App\Admin::class)->create(['password' => Hash::make('qwerty')]);

        $this->actingAs($admin, 'admin')
                ->put(route('admin.settings.update', $admin->id), [
                    '_method'               => 'PUT',
                    'current_password'      => 'qwerty',
                    'password'              => 'qwert',
                    'password_confirmation' => 'qwertyNew'
                ])
                ->assertStatus(302)
                ->assertSessionHasErrors('password');
    }

    /** @test */
    public function password_confirmation_is_required()
    {
        $admin = factory(\App\Admin::class)->create(['password' => Hash::make('qwerty')]);

        $this->actingAs($admin, 'admin')
                ->put(route('admin.settings.update', $admin->id), [
                    '_method'          => 'PUT',
                    'current_password' => 'qwerty',
                    'password'         => 'qwertyNew',
                ])
                ->assertStatus(302)
                ->assertSessionHasErrors('password_confirmation');
    }

    /** @test */
    public function password_confirmation_must_be_the_same_as_password()
    {
        $admin = factory(\App\Admin::class)->create(['password' => Hash::make('qwerty')]);

        $this->actingAs($admin, 'admin')
                ->put(route('admin.settings.update', $admin->id), [
                    '_method'               => 'PUT',
                    'current_password'      => 'qwerty',
                    'password'              => 'qwertyNew1',
                    'password_confirmation' => 'qwertyNew2'
                ])
                ->assertStatus(302)
                ->assertSessionHasErrors('password_confirmation');
    }

}

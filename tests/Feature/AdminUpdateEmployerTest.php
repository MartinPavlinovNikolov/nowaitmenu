<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Employer;

class AdminUpdateEmployerTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function admin_can_turn_off_status_of_employers()
    {

        $admin = factory(\App\Admin::class)->create();
        factory(\App\Employer::class)->states('active')->create([
            'name'   => 'company1'
        ]);

        $this->actingAs($admin, 'admin')
                ->put(route('admin.employers.status.update', 1), [
                    '_method' => 'PUT'
        ]);

        $this->assertFalse(Employer::find(1)->boolean_status);
    }

    /** @test */
    public function admin_can_turn_on_status_of_employers()
    {

        $admin = factory(\App\Admin::class)->create();
        factory(\App\Employer::class)->states('disabled')->create([
            'name'   => 'company1'
        ]);

        $this->actingAs($admin, 'admin')
                ->put(route('admin.employers.status.update', 1), [
                    '_method' => 'PUT'
        ]);

        $employer = Employer::find(1);

        $this->assertTrue(Employer::find(1)->boolean_status);
    }

    /** @test */
    public function admin_cant_change_status_of_employers_if_employer_do_not_exist_and_get_404()
    {
        $admin = factory(\App\Admin::class)->create();

        $this->actingAs($admin, 'admin')
                ->put(route('admin.employers.status.update', 1), [
                    '_method' => 'PUT'
                ])
                ->assertStatus(404)
                ->assertSessionHas('message', 'Employer do not exist!');
    }

    /** @test */
    public function guest_cant_update_employers_status()
    {
        $this->put(route('admin.employers.status.update', 1), [
                    '_method' => 'PUT'
                ])
                ->assertStatus(302);
    }

    /** @test */
    public function employer_cant_update_employers_status()
    {
        $employer = factory(\App\Employer::class)->create();

        $this->actingAs($employer, 'employer')
                ->put(route('admin.employers.status.update', 1), [
                    '_method' => 'PUT'
                ])
                ->assertStatus(302);
    }

    /** @test */
    public function employee_cant_update_employers_status()
    {
        $employee = factory(\App\Employee::class)->create();

        $this->actingAs($employee, 'employee')
                ->put(route('admin.employers.status.update', 1), [
                    '_method' => 'PUT'
                ])
                ->assertStatus(302);
    }

    /** @test */
    public function tablet_cant_update_employers_status()
    {
        $tablet = factory(\App\Tablet::class)->create();

        $this->actingAs($tablet, 'tablet')
                ->put(route('admin.employers.status.update', 1), [
                    '_method' => 'PUT'
                ])
                ->assertStatus(302);
    }

}

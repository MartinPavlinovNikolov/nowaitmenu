<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminDeleteEmployerTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function admin_can_delete_employer_and_all_related_models_to_this_employer()
    {
        $admin = factory(\App\Admin::class)->create();
        factory(\App\Employer::class)->create();
        factory(\App\Employee::class, 2)->create(['employer_id' => '1']);

        $this->assertDatabaseHas('employers', ['id' => '1']);
        $this->assertDatabaseHas('employees', ['id' => '1']);
        $this->assertDatabaseHas('employees', ['id' => '2']);

        $this->actingAs($admin, 'admin')
                ->delete(route('admin.employers.destroy', 1), [
                    '_method' => 'DELETE'
        ]);

        $this->assertDatabaseMissing('employers', ['id' => '1']);
        $this->assertDatabaseMissing('employees', ['id' => '1']);
        $this->assertDatabaseMissing('employees', ['id' => '2']);
    }

    /** @test */
    public function guest_cant_delete_employer()
    {
        $this->delete(route('admin.employers.destroy', 1), [
                    '_method' => 'DELETE'
                ])
                ->assertRedirect(route('admin.login.form'));
    }

    /** @test */
    public function employer_cant_delete_employer()
    {
        $employer = factory(\App\Employer::class)->create();

        $this->actingAs($employer, 'employer')
                ->delete(route('admin.employers.destroy', 1), [
                    '_method' => 'DELETE'
                ])
                ->assertRedirect(route('admin.login.form'));
    }

    /** @test */
    public function employee_cant_delete_employer()
    {
        $employee = factory(\App\Employee::class)->create();

        $this->actingAs($employee, 'employee')
                ->delete(route('admin.employers.destroy', 1), [
                    '_method' => 'DELETE'
                ])
                ->assertRedirect(route('admin.login.form'));
    }

    /** @test */
    public function tablet_cant_delete_employer()
    {
        $tablet = factory(\App\Tablet::class)->create();

        $this->actingAs($tablet, 'tablet')
                ->delete(route('admin.employers.destroy', 1), [
                    '_method' => 'DELETE'
                ])
                ->assertRedirect(route('admin.login.form'));
    }

}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Employee;

class AdminUpdateEmployeeTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function admin_can_turn_off_status_of_employees()
    {
        $admin = factory(\App\Admin::class)->create();
        factory(\App\Employer::class)->create();
        factory(\App\Employee::class)->create([
            'name'        => 'employee1',
            'status'      => true,
            'employer_id' => '1'
        ]);

        $this->actingAs($admin, 'admin')
                ->post('admin/employees/1', [
                    '_method' => 'PUT',
                    'status'  => false
        ]);

        $employee = Employee::find(1);

        $this->assertFalse((bool) $employee->status);
    }

    /** @test */
    public function admin_can_turn_on_status_of_employees()
    {
        $admin = factory(\App\Admin::class)->create();
        factory(\App\Employer::class)->create();
        factory(\App\Employee::class)->create([
            'name'        => 'employee1',
            'status'      => false,
            'employer_id' => '1'
        ]);

        $this->actingAs($admin, 'admin')
                ->post('admin/employees/1', [
                    '_method' => 'PUT',
                    'status'  => true
        ]);

        $employee = Employee::find(1);

        $this->assertTrue((bool) $employee->status);
    }

    /** @test */
    public function guest_cant_access_this_route()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }

    /** @test */
    public function employer_cant_access_this_route()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }

    /** @test */
    public function employee_cant_access_this_route()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }

    /** @test */
    public function tablet_cant_access_this_route()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }

}

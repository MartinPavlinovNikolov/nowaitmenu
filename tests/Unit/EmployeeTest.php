<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Employee;

class EmployeeTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function employee_can_be_created_successiful()
    {
        factory(\App\Employee::class)->create([
            'name' => 'Some Name'
        ]);

        $this->assertEquals('Some Name', Employee::find(1)->name);
    }

    /**
     * @test
     */
    public function employee_can_access_employer()
    {
        $employer = factory(\App\Employer::class)->create([
            'name'        => 'some name'
        ]);

        factory(\App\Employee::class)->create([
            'employer_id' => $employer->id
        ]);

        $this->assertEquals('some name', Employee::find($employer->id)->employer()->first()->name);
    }

}

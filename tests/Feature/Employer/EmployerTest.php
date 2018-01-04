<?php

namespace Tests\Feature\Employer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class EmployerTest extends TestCase
{

    use WithoutMiddleware;
    use RefreshDatabase;

    /**
     * insert all models in database
     * @return object $this
     */
    protected function seedAll()
    {
        $employer = factory(\App\Employer::class)->create([
            'name' => 'Company Example name'
        ]);
        $admins   = factory(\App\Admin::class, 3)->create();

        foreach ($admins as $admin)
        {
            $admin->employers()->attach($employer);
        }
        factory(\App\Status::class)->create([
            'statusable_id'   => $employer->id,
            'statusable_type' => \App\Employer::class
        ]);

        $employees = [];
        for ($i = 1; $i <= 3; $i++)
        {
            $employees[] = factory(\App\Employee::class)->create([
                'name'        => 'Name' . $i,
                'employer_id' => $employer->id
            ]);
        }

        foreach ($employees as $employee)
        {
            factory(\App\Status::class)->create([
                'statusable_id'   => $employee->id,
                'statusable_type' => \App\Employee::class
            ]);
        }
        return $employer;
    }

    /**
     * @test
     */
    public function employer_can_view_all_employees()
    {
        $this->withoutExceptionHandling();
        $employer = $this->seedAll();

        $this->actingAs($employer, 'employer')
                ->get('dashboard')
                ->assertStatus(200)
                ->assertSee('Home')
                ->assertSee('Menu')
                ->assertSee('Printer')
                ->assertSee('Tablets')
                ->assertSee('Employees')
                ->assertSee('Tables')
                ->assertSee('Logout');
    }

    /**
     * @test
     */
    public function employer_can_see_all_employers_who_belogs_to_him()
    {
        $this->withoutExceptionHandling();
        $employer = $this->seedAll();

        $this->actingAs($employer, 'employer')
                ->get('employees')
                ->assertStatus(200)
                ->assertSee('Name1')
                ->assertSee('Name2')
                ->assertSee('Name3');
        foreach($employer->employees() as $employee){
            $this->assertTrue($employee->status()->active);
        }
    }

}

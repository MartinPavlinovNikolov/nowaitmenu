<?php

namespace Tests\Feature\admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Admin;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AdminTest extends TestCase
{

    use WithoutMiddleware;
    use DatabaseMigrations;

    protected function seedAll()
    {
        $Martin    = factory(\App\Admin::class)->create([
            'name' => 'Martin'
        ]);
        $admins    = factory(\App\Admin::class, 2)->create();
        $employers = factory(\App\Employer::class, 20)->create();
        foreach ($employers as $employer)
        {
            $Martin->employers()->attach($employer);
            foreach ($admins as $admin)
            {
                $admin->employers()->attach($employer);
            }
            factory(\App\Status::class)->create([
                'statusable_id'   => $employer->id,
                'statusable_type' => \App\Employer::class
            ]);
            $employees = factory(\App\Employee::class, rand(4, 8))->create([
                'employer_id' => $employer->id
            ]);
            foreach ($employees as $employee)
            {
                factory(\App\Status::class)->create([
                    'statusable_id'   => $employee->id,
                    'statusable_type' => \App\Employee::class
                ]);
            }
        }
        return $Martin;
    }

    /**
     * @test
     */
    public function admin_can_see_the_number_of_all_employers_in_dashboard()
    {
        $admin = factory(\App\Admin::class)->create();

        factory(\App\Employer::class, 20)->create()->each(function($employer) {
            $employer->admins()->attach(Admin::find(1));
        });

        $this->actingAs($admin, 'admin')
                ->get(route('admin.dashboard'))
                ->assertSee('showing from 1-10 of 20');
    }

    /**
     * @test
     */
    public function admin_can_get_corect_structure_of_the_table()
    {
        $admin = factory(\App\Admin::class)->create();

        $this->actingAs($admin, 'admin')
                ->get(route('admin.dashboard'))
                ->assertSee('ID')
                ->assertSee('Company name')
                ->assertSee('E-mail')
                ->assertSee('Date created')
                ->assertSee('Employees')
                ->assertSee('Status')
                ->assertSee('Last Login')
                ->assertSee('Actions');
    }

    /**
     * @test
     */
    public function admin_can_get_dashboard()
    {
        $admin = $this->seedAll();
        $this->actingAs($admin, 'admin')
                ->assertAuthenticated('admin')
                ->get(route('admin.dashboard'))
                ->assertStatus(200);
    }

}

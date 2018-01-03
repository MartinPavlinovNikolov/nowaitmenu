<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{

    use CreatesApplication;

    /**
     * insert all models in database
     * @return object $this
     */
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

}

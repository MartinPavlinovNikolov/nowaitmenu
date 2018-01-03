<?php

namespace Tests\Unit\admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    use WithoutMiddleware;
    use RefreshDatabase;

    /**
     * @test
     */
    public function admin_can_get_all_employers()
    {
        $admin     = factory(\App\Admin::class)->create();
        $employers = factory(\App\Employer::class, 20)->create();
        foreach ($employers as $employer)
        {
            $admin->employers()->attach($employer);
        }

        $result = $admin->getAllEmployers();

        $this->assertCount(20, $result);
    }

}

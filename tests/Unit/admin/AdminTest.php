<?php

namespace Tests\Unit\admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminTest extends TestCase
{

    use WithFaker;
    use WithoutMiddleware;
    use DatabaseMigrations;

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

        $this->assertCount(20, $employers);
    }

}

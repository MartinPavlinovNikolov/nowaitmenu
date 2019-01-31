<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployerViewMenuTest extends TestCase
{

    /** @test */
    public function employer_can_view_all_details_for_menu()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }

    /** @test */
    public function admin_cant_access_this_route()
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

    /** @test */
    public function employee_cant_access_this_route()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }

    /** @test */
    public function guest_cant_access_this_route()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }

}

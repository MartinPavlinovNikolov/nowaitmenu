<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployerLogoutTest extends TestCase
{
    /** @test */
    public function employer_can_logout()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }
    
    /** @test */
    public function admin_cant_access_logout_for_employer()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }
    
    /** @test */
    public function tablet_cant_access_logout_for_employer()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }
    
    /** @test */
    public function employee_cant_access_logout_for_employer()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }
}

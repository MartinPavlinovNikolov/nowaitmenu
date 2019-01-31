<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployerViewTablesListingTest extends TestCase
{
    /** @test */
    public function employer_can_see_list_with_all_tables()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }
    
    /** @test */
    public function employer_can_update_table()
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

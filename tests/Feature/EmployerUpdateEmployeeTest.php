<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployerUpdateEmployeeTest extends TestCase
{
    /** @test */
    public function employer_can_see_correct_form_for_updating_employees()
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
    
    /** @test */
    public function employer_can_change_employee_pin_code()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }
    
    /** @test */
    public function employer_can_rename_employee()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }
    
    /** @test */
    public function name_must_be_at_least_2_characters()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }
    
    /** @test */
    public function pin_code_must_be_4_integers()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }
}

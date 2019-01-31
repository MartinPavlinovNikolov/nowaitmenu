<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployerCreateEmployeeTest extends TestCase
{
    /** @test */
    public function employer_can_access_this_route()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }
    
    /** @test */
    public function deferent_role_except_employer_cant_access_this_route()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }
    
    /** @test */
    public function employer_can_see_correct_form()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }
    
    /** @test */
    public function employer_can_store_new_employee()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }
    
    /** @test */
    public function name_is_required()
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
    public function pin_code_is_required()
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
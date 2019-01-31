<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Employer;
use Illuminate\Support\Carbon;

class EmployerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function employer_can_be_created_successiful()
    {
        factory(\App\Employer::class)->create([
            'name'  => 'Some Name',
            'email' => 'Some@email.com'
        ]);

        $employer = Employer::find(1);

        $this->assertEquals('Some Name', $employer->name);
        $this->assertEquals('Some@email.com', $employer->email);
    }

    /** @test */
    public function employer_have_scope_active()
    {
        factory(\App\Employer::class)->create([
            'name'   => 'companyName',
            'status' => true
        ]);
        
        $this->assertEquals('companyName', Employer::active()->first()->name);
    }

    /** @test */
    public function employer_have_scope_disabled()
    {
        factory(\App\Employer::class)->create([
            'name'   => 'companyName',
            'status' => false
        ]);

        $this->assertEquals('companyName', Employer::disabled()->first()->name);
    }
    
    /** @test */
    public function can_get_formated_last_login()
    {
        $employer = factory(\App\Employer::class)->create(['last_login' => Carbon::parse('2016-01-12')]);
        
        $this->assertEquals('2016/12/01', $employer->formated_last_login);
    }
    
    /** @test */
    public function can_get_formated_created_at()
    {
        $employer = factory(\App\Employer::class)->create(['created_at' => Carbon::parse('2016-01-12')]);
        
        $this->assertEquals('2016/12/01', $employer->formated_created_at);
    }
    
    /** @test */
    public function can_get_formated_updated_at()
    {
        $employer = factory(\App\Employer::class)->create(['updated_at' => Carbon::parse('2016-01-12')]);
        
        $this->assertEquals('2016/12/01', $employer->formated_updated_at);
    }
    
    /** @test */
    public function can_get_boolean_status()
    {
        $employer = factory(\App\Employer::class)->create(['status' => true]);
        
        $this->assertTrue($employer->boolean_status);
    }
}

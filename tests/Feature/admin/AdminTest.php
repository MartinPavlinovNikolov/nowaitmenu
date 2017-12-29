<?php

namespace Tests\Feature\admin;

use Tests\TestCase;
use App\Admin;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
    public function admin_can_see_correct_structure_of_table()
    {
        $response = $this->get('admin');
        $response->assertSee('ID');
        $response->assertSee('Company name');
        $response->assertSee('E-mail');
        $response->assertSee('Date created');
        $response->assertSee('Employees');
        $response->assertSee('Status');
        $response->assertSee('Last Login');
        $response->assertSee('Actions');
    }

    /**
     * @test
     */
    public function admin_can_be_createat()
    {

        $admin = factory(\App\Admin::class)->create([
            'name' => 'TestName'
        ]);

        $this->assertEquals($admin->name, 'TestName');
    }
    
}

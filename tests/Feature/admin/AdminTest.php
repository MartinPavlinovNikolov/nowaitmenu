<?php

namespace Tests\Feature\admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AdminTest extends TestCase
{

    use WithoutMiddleware;

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

}

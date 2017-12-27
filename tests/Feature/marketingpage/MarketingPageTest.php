<?php

namespace Tests\Feature\marketingpage;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MarketingPageTest extends TestCase
{
    /** 
     * @test
     */
    public function can_browser_get_responce_200_when_visit_marketing_page()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    
    /**
     * @test
     */
    public function can_user_see_correct_text_in_the_marketing_page()
    {
        $response = $this->get('/');
        $response->assertSee('NoWaitMenu')
        ->assertSee('try it free')
        ->assertSee('Features')
        ->assertSee('Pricing')
        ->assertSee('Support')
        ->assertSee('Register')
        ->assertSee('Login')
        ->assertSee('Get your restaurant runing in minutes');
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;

class MarketingTest extends TestCase
{
    /** @test */
    public function user_can_view_important_links_in_marketing_page()
    {
        $this->get('/')
                ->assertSee('Login')
                ->assertSee('Register')
                ->assertSee('try it free');
    }
    
    /** @test */
    public function user_can_view_marketing_page()
    {
        $this->get('/')
                ->assertStatus(200);
    }
}

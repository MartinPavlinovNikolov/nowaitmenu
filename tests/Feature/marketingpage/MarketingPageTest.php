<?php

namespace Tests\Feature\marketingpage;

use Tests\TestCase;

class MarketingPageTest extends TestCase
{

    /**
     * @test
     */
    public function can_browser_get_responce_200_when_visit_marketing_page()
    {
        $this->get('/')
                ->assertStatus(200);
    }

    /**
     * @test
     */
    public function can_user_see_correct_text_in_the_marketing_page()
    {
        $this->get('/')
                ->assertSee('NoWaitMenu')
                ->assertSee('try it free')
                ->assertSee('Features')
                ->assertSee('Pricing')
                ->assertSee('Support')
                ->assertSee('Register')
                ->assertSee('Login')
                ->assertSee('Get your restaurant runing in minutes');
    }

}

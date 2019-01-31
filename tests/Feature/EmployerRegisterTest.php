<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployerRegisterTest extends TestCase
{

    /** @test */
    public function employer_can_get_registration_form()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }

    /** @test */
    public function authenticated_employer_cant_get_registration_form()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }

    /** @test */
    public function deferent_role_except_user_will_be_redirected_from_registration()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }

    /** @test */
    public function guest_can_see_correct_form()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }

    /** @test */
    public function guest_can_be_register_as_employer()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }

    /** @test */
    public function Name_is_require_for_registration()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }

    /** @test */
    public function Name_must_be_more_then_2_characters()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }

    /** @test */
    public function Name_must_be_less_then_100_characters()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }

    /** @test */
    public function email_is_require_for_registration()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }

    /** @test */
    public function email_must_be_valid_email()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }

    /** @test */
    public function password_is_require_for_registration()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }

    /** @test */
    public function password_must_be_at_least_8_characters()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }

    /** @test */
    public function confirm_password_is_required_for_registration()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }

    /** @test */
    public function confirm_password_must_be_the_same_as_password()
    {
        $this->withoutExceptionHandling();

        $this->markTestIncomplete();
    }

}

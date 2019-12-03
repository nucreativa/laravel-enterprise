<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_a_forgot_password_page()
    {
        $response = $this->get('/password/reset');

        $response->assertSuccessful();
        $response->assertViewIs('auth.passwords.email');
    }
}

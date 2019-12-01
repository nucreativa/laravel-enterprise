<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_a_login_form()
    {
        $response = $this->get(route('login'));

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function test_login_with_correct_credentials()
    {
        $user = factory(User::class)->create();
        $response = $this->postJson(route('login'), [
            'email' => $user->email,
            'password' => 'secret',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_with_incorrect_credentials()
    {
        $response = $this->postJson('/login', []);

        $response->assertStatus(422);
    }
}

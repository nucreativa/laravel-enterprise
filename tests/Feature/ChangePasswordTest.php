<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChangePasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_open_page_when_authenticated()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get(route('password.change'));

        $response->assertStatus(200);
    }

    public function test_open_page_when_not_authenticated()
    {
        $response = $this->get(route('password.change'));

        $response->assertRedirect(route('login'));
    }

    public function test_change_password_successfully()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('password.change'));
        $response = $this->postJson(route('password.post_change', [
            'current_password' => 'secret',
            'password' => '#itssecret',
            'password_confirmation' => '#itssecret',
        ]));

        $response->assertRedirect(route('password.change'));
    }

    public function test_change_password_with_weak_password()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('password.change'));
        $response = $this->postJson(route('password.post_change', [
            'current_password' => 'secret',
            'password' => 'weakpassword',
            'password_confirmation' => 'weakpassword',
        ]));

        $response->assertStatus(422);
    }

    public function test_change_password_with_confirmation_password_not_same()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('password.expired'));
        $response = $this->postJson(route('password.post_change'), [
            'current_password' => 'secret',
            'password' => 'weakpassword',
            'password_confirmation' => 'weakpassword123',
        ]);

        $response->assertStatus(422);
    }
}

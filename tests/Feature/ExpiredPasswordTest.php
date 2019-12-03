<?php

namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExpiredPasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test open /home when password has been expired.
     *
     * @return void
     */
    public function test_open_home_when_password_expired()
    {
        $user = factory(User::class)->create([
            'password_changed_at' => Carbon::now()->subYear(),
        ]);
        $response = $this->actingAs($user)->get(route('home'));

        $response->assertRedirect(route('password.expired'));
    }

    public function test_change_password_successfully()
    {
        $user = factory(User::class)->create([
            'password_changed_at' => $date = Carbon::now()->subYear(),
        ]);
        $this->actingAs($user)->get(route('password.expired'));
        $response = $this->postJson(route('password.post_expired'), [
            'current_password' => 'secret',
            'password' => 'secret-now',
            'password_confirmation' => 'secret-now',
        ]);

        $response->assertRedirect(route('password.expired'));
    }

    public function test_change_password_with_incorrect_current_password()
    {
        $user = factory(User::class)->create([
            'password_changed_at' => $date = Carbon::now()->subYear(),
        ]);
        $this->actingAs($user)->get(route('password.expired'));
        $response = $this->postJson(route('password.post_expired'), [
            'current_password' => 'secret-wrong',
            'password' => 'secret-now',
            'password_confirmation' => 'secret-now',
        ]);

        $response->assertStatus(422);
    }

    public function test_change_password_with_confirmation_password_not_same()
    {
        $user = factory(User::class)->create([
            'password_changed_at' => $date = Carbon::now()->subYear(),
        ]);
        $this->actingAs($user)->get(route('password.expired'));
        $response = $this->postJson(route('password.post_expired'), [
            'current_password' => 'secret',
            'password' => 'secret-now',
            'password_confirmation' => 'secret-now-wrong',
        ]);

        $response->assertStatus(422);
    }
}

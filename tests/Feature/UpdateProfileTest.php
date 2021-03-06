<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_open_page_when_authenticated()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get(route('profile.update'));

        $response->assertStatus(200);
    }

    public function test_open_page_when_not_authenticated()
    {
        $response = $this->get(route('profile.update'));

        $response->assertRedirect(route('login'));
    }

    public function test_update_profile()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('profile.update'));
        $response = $this->postJson(route('profile.post_update'), [
            'name' => 'New Name',
        ]);

        $response->assertRedirect(route('profile.update'));
    }

    public function test_update_profile_with_errors()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('profile.update'));
        $response = $this->postJson(route('profile.post_update'), [
            'name' => '',
        ]);

        $response->assertStatus(422);
    }
}

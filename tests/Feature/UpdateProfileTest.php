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
        $response = $this->actingAs($user)->get('/profile/update');

        $response->assertStatus(200);
    }

    public function test_open_page_when_not_authenticated()
    {
        $response = $this->get('/profile/update');

        $response->assertRedirect('/login');
    }
}

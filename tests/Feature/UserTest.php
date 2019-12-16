<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_open_index_page()
    {
        (new \DatabaseSeeder())->call(\RolesTableSeeder::class);
        (new \DatabaseSeeder())->call(\PermissionGroupsTableSeeder::class);
        $user = factory(User::class)->create();
        $user->assignRole('administrator');
        $response = $this->actingAs($user)->get(route('users.index'));

        $response->assertStatus(200);
    }

    public function test_open_index_page_without_login()
    {
        $response = $this->get(route('users.index'));

        $response->assertStatus(403);
    }

    public function test_create_new_user()
    {
        (new \DatabaseSeeder())->call(\RolesTableSeeder::class);
        (new \DatabaseSeeder())->call(\PermissionGroupsTableSeeder::class);
        $user = factory(User::class)->create();
        $user->assignRole('administrator');
        $this->actingAs($user)->get(route('users.index'));

        $response = $this->postJson(route('users.store'), [
            'name' => 'New User User',
            'email' => 'new.user@test.com',
            'password' => 'secret-now',
            'password_confirmation' => 'secret-now',
        ]);

        $response->assertRedirect(route('users.index'));
    }

    public function test_create_new_user_with_errors()
    {
        (new \DatabaseSeeder())->call(\RolesTableSeeder::class);
        (new \DatabaseSeeder())->call(\PermissionGroupsTableSeeder::class);
        $user = factory(User::class)->create();
        $user->assignRole('administrator');
        $this->actingAs($user)->get(route('users.index'));

        $response = $this->postJson(route('users.store'), [
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $response->assertStatus(422);
    }
}

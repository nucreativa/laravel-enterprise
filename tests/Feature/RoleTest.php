<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_open_index_page()
    {
        (new \DatabaseSeeder())->call(\RolesTableSeeder::class);
        (new \DatabaseSeeder())->call(\PermissionGroupsTableSeeder::class);
        $user = factory(User::class)->create();
        $user->assignRole('administrator');
        $response = $this->actingAs($user)->get(route('roles.index'));

        $response->assertStatus(200);
    }

    public function test_open_index_page_without_login()
    {
        $response = $this->get(route('roles.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_create_new_role()
    {
        (new \DatabaseSeeder())->call(\RolesTableSeeder::class);
        (new \DatabaseSeeder())->call(\PermissionGroupsTableSeeder::class);
        $user = factory(User::class)->create();
        $user->assignRole('administrator');
        $this->actingAs($user)->get(route('roles.index'));

        $response = $this->postJson(route('roles.store'), [
            'name' => 'New Role',
            'permissions' => [],
        ]);

        $response->assertRedirect(route('roles.index'));
    }
}

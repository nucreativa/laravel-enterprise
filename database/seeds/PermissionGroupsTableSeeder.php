<?php

use Illuminate\Database\Seeder;

class PermissionGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            'Administrator Tools' => [
                'Uptime Monitor' => [
                    'can_manage_uptime',
                ],
            ],
            'User Management' => [
                'Users' => [
                    'can_view_users',
                    'can_edit_user',
                    'can_add_user',
                ],
                'Roles' => [
                    'can_view_roles',
                    'can_edit_role',
                    'can_add_role',
                ],
                'Permissions' => [
                    'can_view_permissions',
                    'can_edit_permission',
                    'can_add_permission',
                ],
            ],
        ];

        foreach ($groups as $group => $menus) {
            $pg = \App\PermissionGroup::create([
                'name' => $group,
            ]);

            foreach ($menus as $menu => $permissions) {
                $pgc = \App\PermissionGroup::create([
                    'name' => $menu,
                    'parent_id' => $pg->id,
                ]);

                foreach ($permissions as $permission) {
                    $p = \App\Permission::create([
                        'name' => $permission,
                        'group_id' => $pgc->id,
                    ]);
                }
            }
        }
    }
}

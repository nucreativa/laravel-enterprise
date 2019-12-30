<?php

namespace App\Http\Controllers;

use App\Exports\RolesExport;
use App\Http\Requests\RoleRequest;
use App\PermissionGroup;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with(['permissions', 'users'])->get();
        $permissionGroups = PermissionGroup::with('childs.permissions')->whereNull('parent_id')->get();

        return view('role.index', compact(['roles', 'permissionGroups']));
    }

    public function store(RoleRequest $request)
    {
        $data = $request->all();
        $permissions = $data['permissions'];
        unset($data['permissions']);
        $role = Role::create($data);
        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }
        Cache::forget('roles');

        return redirect(route('roles.index'));
    }

    public function edit(Role $role)
    {
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        $permissionGroups = PermissionGroup::with('childs.permissions')->whereNull('parent_id')->get();

        return view('role.edit', compact(['role', 'rolePermissions', 'permissionGroups']));
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->name,
        ]);
        $role->syncPermissions($request->permissions);
        Cache::forget('roles');

        return redirect()->route('roles.index');
    }

    public function export()
    {
        return Excel::download(new RolesExport(), 'roles.xlsx');
    }
}

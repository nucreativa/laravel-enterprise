<?php

namespace App\Http\Controllers;

use App\Exports\PermissionsExport;
use App\Http\Requests\PermissionRequest;
use App\Permission;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Cache::remember('permissions', 120, function () {
            return Permission::with(['roles', 'users'])->get();
        });
        $roles = Cache::remember('roles', 120, function () {
            return Role::all();
        });

        return view('permission.index', compact(['permissions', 'roles']));
    }

    public function store(PermissionRequest $request)
    {
        $data = $request->all();
        $roles = $data['roles'];
        unset($data['roles']);
        $permission = Permission::create($data);
        $permission->syncRoles($roles);
        Cache::forget('permissions');

        return redirect(route('permissions.index'));
    }

    public function edit(Permission $permission)
    {
        $permissionRoles = $permission->roles()->pluck('id')->toArray();
        $roles = Cache::remember('roles', 120, function () {
            return Role::all();
        });

        return view('permission.edit', compact(['permission', 'permissionRoles', 'roles']));
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        $permission->update([
            'name' => $request->name,
        ]);
        $permission->syncRoles($request->roles);
        Cache::forget('permissions');

        return redirect()->route('permissions.index');
    }

    public function export()
    {
        return Excel::download(new PermissionsExport(), 'permissions.xlsx');
    }
}

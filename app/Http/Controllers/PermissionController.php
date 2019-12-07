<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    private $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function index()
    {
        $permissions = $this->permission->with(['roles', 'users'])->paginate(10);
        $roles = Role::all();

        return view('permission.index', compact(['permissions', 'roles']));
    }

    public function add()
    {
        $data = $this->validate(request(), [
            'name' => 'required|string|max:191',
            'roles' => 'present|array',
        ]);
        $roles = $data['roles'];
        unset($data['roles']);

        $permission = $this->permission->create($data);
        foreach ($roles as $role) {
            $permission->assignRole($role);
        }

        return redirect(route('permission.index'));
    }

    public function edit($id)
    {
        $permission = $this->permission->find($id);
        $permissionRoles = $permission->roles->pluck('id')->toArray();
        $roles = Role::all();

        return view('permission.edit', compact(['permission', 'permissionRoles', 'roles']));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        Permission::where('id', $id)->update([
            'name' => $data['name'],
        ]);
        $role = Permission::find($id);
        $role->syncRoles($data['roles']);

        return redirect()->route('permission.index');
    }
}

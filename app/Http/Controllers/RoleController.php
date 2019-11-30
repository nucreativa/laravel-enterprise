<?php

namespace App\Http\Controllers;

use App\PermissionGroup;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    private $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function index()
    {
        $roles = $this->role->with(['permissions', 'users'])->paginate(10);
        $permissionGroups = PermissionGroup::with('childs.permissions')->whereNull('parent_id')->get();

        return view('role.index', compact(['roles', 'permissionGroups']));
    }

    public function add()
    {
        $data = $this->validate(request(), [
            'name' => 'required|string|max:191',
            'permissions' => 'present|array',
        ]);
        $permissions = $data['permissions'];
        unset($data['permissions']);

        $role = $this->role->create($data);
        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }

        return redirect(route('role.index'));
    }

    public function edit($id)
    {
        $role = $this->role->with('permissions')->find($id);
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        $permissionGroups = PermissionGroup::with('childs.permissions')->whereNull('parent_id')->get();

        return view('role.edit', compact(['role', 'rolePermissions', 'permissionGroups']));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        Role::where('id', $id)->update([
            'name' => $data['name'],
        ]);
        $role = Role::find($id);
        $role->syncPermissions($data['permissions']);

        return redirect()->route('role.index');
    }
}

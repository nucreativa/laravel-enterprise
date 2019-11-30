<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $users = User::paginate(10);

        return view('user.index', compact('users'));
    }

    public function edit($id)
    {
        $user = $this->user->with('roles')->find($id);
        $userRoles = $user->roles()->pluck('id')->toArray();
        $roles = Role::all();

        return view('user.edit', compact(['user', 'roles', 'userRoles']));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        User::where('id',$id)->update([
           'name' => $data['name'],
        ]);
        $user = User::find($id);
        $user->syncRoles($data['roles']);

        return redirect()->route('user.index');
    }

    public function export()
    {
        return Excel::download(new UsersExport(), 'users.xlsx');
    }
}

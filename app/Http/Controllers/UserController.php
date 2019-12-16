<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = Cache::remember('users', 120, function () {
            return User::all();
        });

        return view('user.index', compact('users'));
    }

    public function store()
    {
        $data = $this->validate(request(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        Cache::forget('users');

        return redirect(route('users.index'));
    }

    public function edit(User $user)
    {
        $userRoles = $user->roles()->pluck('id')->toArray();
        $roles = Cache::remember('roles', 120, function () {
            return Role::all();
        });

        return view('user.edit', compact(['user', 'roles', 'userRoles']));
    }

    public function update(Request $request, User $user)
    {
        $data = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'roles' => ['present', 'array'],
        ]);
        $user->update([
            'name' => $data['name'],
        ]);
        $user->syncRoles($data['roles']);
        Cache::forget('users');

        return redirect()->route('users.index');
    }

    public function export()
    {
        return Excel::download(new UsersExport(), 'users.xlsx');
    }
}

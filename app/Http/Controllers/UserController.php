<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
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

    public function store(CreateUserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
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

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update([
            'name' => $request->name,
        ]);
        $user->syncRoles($request->roles);
        Cache::forget('users');

        return redirect()->route('users.index');
    }

    public function export()
    {
        return Excel::download(new UsersExport(), 'users.xlsx');
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('change-password');
    }

    public function update()
    {
        // Checking current password
        if (! Hash::check(request()->input('old_password'), auth()->user()->password)) {
            return response([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'old_password' => ['Wrong password'],
                ],
            ], 422);
        }

        $data = $this->validate(request(), [
            'new_password' => 'required|string|min:8',
            'confirm' => 'required|same:new_password',
        ]);

        auth()->user()->update([
            'password' => $data['new_password'],
            'password_changed_at' => Carbon::now()->toDateTimeString(),
        ]);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordExpiredRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ExpiredPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Expired Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling expired password.
    |
    */

    public function expired()
    {
        return view('auth.passwords.expired');
    }

    public function postExpired(PasswordExpiredRequest $request)
    {
        // Checking current password
        if (! Hash::check($request->current_password, $request->user()->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is not correct']);
        }

        $request->user()->update([
            'password' => $request->password,
            'password_changed_at' => Carbon::now()->toDateTimeString(),
        ]);

        return redirect()->back()->with(['status' => 'Password changed successfully']);
    }
}

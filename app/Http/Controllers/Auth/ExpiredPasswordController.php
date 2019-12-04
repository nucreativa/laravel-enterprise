<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

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

    public function index()
    {
        return view('auth.passwords.expired');
    }
}

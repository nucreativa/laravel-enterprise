<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileController extends Controller
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
        $user = Auth::user();

        return view('auth.profile', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $request->user()->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with(['status' => 'Profile has been updated successfully']);
    }
}

<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class PasswordExpired
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $password_changed_at = new Carbon($user->password_changed_at ?? $user->created_at);

        $daysDiff = Carbon::now()->diffInDays($password_changed_at);
        if ($daysDiff >= config('auth.password_expires_days')) {
            return redirect()->route('password.expired');
        }
        $daysLeft = config('auth.password_expires_days') - $daysDiff;
        if ($daysLeft <= 7) {
            $request->session()->flash('warning', 'Your password will expired in '.$daysLeft.' day(s). Please change your password <a href="'.route('password.change').'">here</a>.');
        }

        return $next($request);
    }
}

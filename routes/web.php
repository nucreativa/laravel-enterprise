<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (\Auth::check()) {
        return redirect()->route('home');
    }

    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::middleware(['auth'])->group(function () {
    Route::post('profile/update', 'Auth\UpdateProfileController@update')->name('profile.post_update');
    Route::get('profile/update', 'Auth\UpdateProfileController@index')->name('profile.update');
    Route::post('password/change', 'Auth\ChangePasswordController@update')->name('password.post_change');
    Route::get('password/change', 'Auth\ChangePasswordController@index')->name('password.change');
    Route::get('password/expired', 'Auth\ExpiredPasswordController@index')->name('password.expired');
});

Route::middleware(['role:administrator'])->group(function () {
    Route::get('/permissions/export', 'PermissionController@export')->name('permissions.export');
    Route::resource('permissions', 'PermissionController')->except([
        'show',
        'create',
        'destroy',
    ]);

    Route::get('/roles/export', 'RoleController@export')->name('roles.export');
    Route::resource('roles', 'RoleController')->except([
        'show',
        'create',
        'destroy',
    ]);

    Route::get('/users/export', 'UserController@export')->name('users.export');
    Route::resource('users', 'UserController')->except([
        'show',
        'destroy',
    ]);
});

Route::get('/home', 'HomeController@index')->name('home');

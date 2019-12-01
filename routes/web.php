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

Route::group(['middleware' => ['auth']], function () {
    Route::post('profile/update', 'Auth\UpdateProfileController@update')->name('profile.post_update');
    Route::get('profile/update', 'Auth\UpdateProfileController@index')->name('profile.update');
    Route::post('password/change', 'Auth\ChangePasswordController@update')->name('password.post_change');
    Route::get('password/change', 'Auth\ChangePasswordController@index')->name('password.change');
    Route::get('password/expired', 'Auth\ExpiredPasswordController@expired')->name('password.expired');
    Route::post('password/post_expired', 'Auth\ExpiredPasswordController@postExpired')->name('password.post_expired');
});

Route::group(['middleware' => ['role:administrator']], function () {
    Route::post('/permissions', 'PermissionController@add')->name('permission.add');
    Route::post('/permissions/{id}', 'PermissionController@update')->name('permission.update');
    Route::get('/permissions/{id}', 'PermissionController@edit')->name('permission.edit');
    Route::get('/permissions', 'PermissionController@index')->name('permission.index');
    Route::post('/roles', 'RoleController@add')->name('role.add');
    Route::post('/roles/{id}', 'RoleController@update')->name('role.update');
    Route::get('/roles/{id}', 'RoleController@edit')->name('role.edit');
    Route::get('/roles', 'RoleController@index')->name('role.index');

    Route::get('/users/export', 'UserController@export')->name('user.export');
    Route::post('/users/{id}', 'UserController@update')->name('user.update');
    Route::get('/users/{id}', 'UserController@edit')->name('user.edit');
    Route::get('/users', 'UserController@index')->name('user.index');
});

Route::get('/home', 'HomeController@index')->name('home');

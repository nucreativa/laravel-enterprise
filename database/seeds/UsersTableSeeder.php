<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'name' => 'Ary Wibowo',
            'email' => 'nucreativa@gmail.com',
            'password' => 'secret',
        ]);
        $user->assignRole('administrator');
    }
}

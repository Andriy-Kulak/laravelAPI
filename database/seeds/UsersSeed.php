<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'andkulak@gmail.com',
            'password' => Hash::make('pass')

        ]);
    }
}
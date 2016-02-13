<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Amitav Roy',
            'email' => 'reachme@amitavroy.com',
            'password' => \Illuminate\Support\Facades\Hash::make('pass'),
            'first_name' => 'Amitav',
            'last_name' => 'Roy',
            'status' => 1
        ]);
    }
}

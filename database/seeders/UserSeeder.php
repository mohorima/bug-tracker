<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin user
        User::create([
            'name' => 'Rima Chowdhury',
            'email' => 'rima@gmail.com',
            'password' => Hash::make('rima1234'),
            'role_id' => '1',
        ]);

        //Normal user
        User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'password' => Hash::make('john1234'),
            'role_id' => '2',
        ]);

        //Normal user
        User::create([
            'name' => 'Jane Brown',
            'email' => 'janebrown@gmail.com',
            'password' => Hash::make('jane1234'),
            'role_id' => '2',
        ]);

        //Manager
        User::create([
            'name' => 'David Smith',
            'email' => 'davidsmith@gmail.com',
            'password' => Hash::make('david1234'),
            'role_id' => '3',
        ]);

        //Team Leader
        User::create([
            'name' => 'Milly Blue',
            'email' => 'millyblue@gmail.com',
            'password' => Hash::make('milly1234'),
            'role_id' => '4',
        ]);
    }
}

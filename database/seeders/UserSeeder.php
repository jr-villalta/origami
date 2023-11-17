<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'vf19012@ues.edu.sv',
            'password' => Hash::make('admin'),
            'level' => 'Admin'
        ]);

        \App\Models\User::create([
            'name' => 'junior',
            'email' => 'jr.villalta99@gmail.com',
            'password' => Hash::make('user'),
            'level' => 'User'
        ]);

        \App\Models\User::create([
            'name' => 'Cristian',
            'email' => 'ge190008@ues.edu.sv',
            'password' => Hash::make('admin'),
            'level' => 'Admin'
        ]);

        // admin
        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin',
            'password' => Hash::make('admin'),
            'level' => 'Admin'
        ]);
    }
}

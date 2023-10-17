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
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'npm' => '00000001',
            'role' => 'admin',
            'departemen' => 'ADM',
            'password' => Hash::make('admin123'),
        ]);

        User::create([
            'name' => 'Shafa',
            'npm' => '2308107010002',
            'role' => 'user',
            'departemen' => 'SOSMAS',
            'password' => Hash::make('Shafa123'),
        ]);

        User::create([
            'name' => 'Disya',
            'npm' => '2308107010060',
            'role' => 'user',
            'departemen' => 'DPH',
            'password' => Hash::make('Disya123'),
        ]);
    }
}

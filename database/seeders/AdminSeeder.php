<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@cbt.com',
            'matric_no' => null,
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);
    }
}

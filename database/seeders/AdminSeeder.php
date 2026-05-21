<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
{
    User::updateOrCreate(
        ['email' => 'admin@cbt.com'],
        [
            'name' => 'System Admin',
            'matric_no' => null,
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]
    );
}
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeader extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'Admin',
            'email' => 'admin@example.com',
            'is_admin' => true,
            'password' => Hash::make('rahasia123'),
        ]);

        User::factory()->create([
            'username' => 'Nafis',
            'email' => 'user@example.com',
            'is_admin' => false,
            'password' => Hash::make('rahasia123'),
        ]);

        User::factory(4)->create([
            'is_admin' => false,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin User 1',
                'email' => 'admin1@admin.com',
                'password' => Hash::make('admin'), // Encrypt the password
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Admin User 2',
                'email' => 'admin2@admin.com',
                'password' => Hash::make('admin'), // Encrypt the password
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}

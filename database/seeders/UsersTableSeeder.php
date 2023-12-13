<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'id' => 1,
                'name' => 'jhan',
                'email' => 'jhan@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$10$MF50kVjCHCw92mgZO4VU0OuwZbhc01qfTacNW7opb5LDkFqqt6Cr6',
                'remember_token' => null,
                'created_at' => '2023-12-08 02:13:31',
                'updated_at' => '2023-12-08 02:13:31',
                'role' => 0,
            ],
            [
                'id' => 2,
                'name' => 'admin1',
                'email' => 'admin1@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$10$UJk3wdz6giX5CE/pPJKWcOh9yzyw/tVaH5smR.A6ziLqf2Jy0HDvK',
                'remember_token' => null,
                'created_at' => '2023-12-08 02:22:12',
                'updated_at' => '2023-12-08 02:22:12',
                'role' => 1,
            ],
            // Add more users as needed
        ]);
    }
}

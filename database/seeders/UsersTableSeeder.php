<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            // Insert the users with specific roles
            DB::table('users')->insert([
                [
                    'name' => 'user',
                    'email' => 'user@example.com',
                    'password' => bcrypt('password123'), // Use bcrypt for password
                    'role' => 0,
                ],
                [
                    'name' => 'teacher',
                    'email' => 'teacher@example.com',
                    'password' => bcrypt('password123'),
                    'role' => 1,
                ],
                [
                    'name' => 'admin',
                    'email' => 'admin@example.com',
                    'password' => bcrypt('password123'),
                    'role' => 2,
                ],
                [
                    'name' => 'bursar',
                    'email' => 'bursar@example.com',
                    'password' => bcrypt('password123'),
                    'role' => 3,
                ]
            ]);
        }

}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
              'name'=>'User',
              'email'=>'user@example.com',
              'password'=>  bcrypt('password123'),
              'role'=> 0  
            ],
            [
                'name'=>'Teacher',
                'email'=>'teacher@example.com',
                'password'=>  bcrypt('password123'),
                'role'=> 1  
            ],
            [
                'name'=>'Admin',
                'email'=>'admin@example.com',
                'password'=> bcrypt('password123'),
                'role'=> 2 
              ]



            ];
            foreach($users as $user)
            {
                User::create($user);
            }
    }
}

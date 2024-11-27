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
                'name'=>'Bursar',
                'email'=>'bursar@example.com',
                'password'=> bcrypt('password123'),
                'role'=> 3
              ]



            ];
            foreach($users as $user)
            {
                User::create($user);
            }
    }
}

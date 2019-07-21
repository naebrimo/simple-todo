<?php

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
        $initialUsers = [
            [
                'name' => 'john doe',
                'email' => 'johndoe@example.com',
                'username' => 'johndoe',
                'password' => bcrypt('password123'),
            ],
            [
                'name' => 'jane doe',
                'email' => 'janedoe@example.com',
                'username' => 'janedoe',
                'password' => bcrypt('password123'),
            ]
        ];

        $user = new App\User;

        $user->insert($initialUsers);
    }
}

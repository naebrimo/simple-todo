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
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'jane doe',
                'email' => 'janedoe@example.com',
                'username' => 'janedoe',
                'password' => bcrypt('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        $user = new App\User;

        $user->insert($initialUsers);
    }
}

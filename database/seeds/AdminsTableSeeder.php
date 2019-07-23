<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
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
                'name' => 'richard roe',
                'email' => 'superuser@example.com',
                'username' => 'root',
                'password' => bcrypt('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        $admin = new App\Admin;

        $admin->insert($initialUsers);
    }
}

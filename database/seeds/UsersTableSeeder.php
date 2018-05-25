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
        DB::table('users')->insert([
            [
                'name' => 'Administrator',
                'email' => 'admin@user.com',
                'password' => bcrypt('secret'),
                'phone' => '0',
                'blocked' => false,
                'role' => 'admin'
            ],
            [
                'name' => 'User',
                'email' => 'user@user.com',
                'password' => bcrypt('secret'),
                'phone' => '0',
                'blocked' => false,
                'role' => 'user'
            ]
        ]);
    }
}

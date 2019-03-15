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
        App\User::create([
            'name' => 'Super User',
            'email' => 'superuser@test.com',
            'role' => 'SUPERUSER',
            'password' => bcrypt('password')
        ]);
    }
}

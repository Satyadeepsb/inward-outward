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
            'username' => 'superuser',
            'mobile' => 8421376507,
            'department' => 0,
            'role' => 'SUPERUSER',
            'password' => bcrypt('password')
        ]);
        App\User::create([
            'name' => 'User',
            'email' => 'user@test.com',
            'username' => 'user',
            'mobile' => 8421376507,
            'department' => 0,
            'role' => 'INWARD',
            'password' => bcrypt('password')
        ]);
        App\User::create([
            'name' => 'PA',
            'email' => 'pa@test.com',
            'username' => 'pa',
            'mobile' => 8421376507,
            'department' => 0,
            'role' => 'PA_USER',
            'password' => bcrypt('password')
        ]);
        App\User::create([
            'name' => 'Clerk',
            'email' => 'clerk@test.com',
            'username' => 'clerk',
            'mobile' => 8421376507,
            'department' => 0,
            'role' => 'CLERK',
            'password' => bcrypt('password')
        ]);
        App\User::create([
            'name' => 'Dept User 1',
            'email' => 'dept1@test.com',
            'username' => 'dept1',
            'mobile' => 8421376507,
            'department' => 1,
            'role' => 'DEPARTMENT_USER',
            'password' => bcrypt('password')
        ]);
        App\User::create([
            'name' => 'Dept User 2',
            'email' => 'dept2@test.com',
            'username' => 'dept2',
            'mobile' => 8421376507,
            'department' => 2,
            'role' => 'DEPARTMENT_USER',
            'password' => bcrypt('password')
        ]);
        App\User::create([
            'name' => 'Dept User 3',
            'email' => 'dept3@test.com',
            'username' => 'dept3',
            'mobile' => 8421376507,
            'department' => 3,
            'role' => 'DEPARTMENT_USER',
            'password' => bcrypt('password')
        ]);
    }
}

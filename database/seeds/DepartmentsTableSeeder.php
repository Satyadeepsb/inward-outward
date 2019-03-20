<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Department::create([
            'name'=>'Water Supply'
        ]);
        App\Department::create([
            'name'=>'Electricity'
        ]);
    }
}

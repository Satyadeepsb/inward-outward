<?php

use Illuminate\Database\Seeder;

class DesignationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Designation::create(['name' => 'Software Engineer']);
        App\Designation::create(['name' => 'Mechanical Engineer']);
        App\Designation::create(['name' => 'Electronic Engineer']);
    }
}

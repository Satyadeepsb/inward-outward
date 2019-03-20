<?php

use Illuminate\Database\Seeder;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\District::create([
            'name'=>'Kolhapur'
        ]);
        App\District::create([
            'name'=>'Satara'
        ]);
    }
}

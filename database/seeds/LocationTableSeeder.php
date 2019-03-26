<?php

use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Location::create(['name' => 'Pune, Maharashtra']);
        App\Location::create(['name' => 'Kolhapur, Maharashtra']);
        App\Location::create(['name' => 'Ahmednagar, Maharashtra']);
    }
}

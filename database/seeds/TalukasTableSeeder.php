<?php

use Illuminate\Database\Seeder;

class TalukasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Taluka::create([
            'name'=>'Karveer',
            'district_id'=>'1'
        ]);
        App\Taluka::create([
            'name'=>'Kagal',
            'district_id'=>'1'
        ]);
        App\Taluka::create([
            'name'=>'Karad',
            'district_id'=>'2'
        ]);
        App\Taluka::create([
            'name'=>'Hupari',
            'district_id'=>'3'
        ]);

    }
}

<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Setting::create([
            'name' => 'email',
            'enable' => false
        ]);
        App\Setting::create([
            'name' => 'sms',
            'enable' => false
        ]);
    }
}

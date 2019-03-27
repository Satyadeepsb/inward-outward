<?php

use Illuminate\Database\Seeder;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Config::create([
            'param_name' => 'url',
            'param_value' => 'http://www.smsjust.com/sms/user/urlsms.php'
        ]);
        App\Config::create([
            'param_name' => 'username',
            'param_value' => 'techuser'
        ]);
        App\Config::create([
            'param_name' => 'pass',
            'param_value' => 'tech@12345'
        ]);
        App\Config::create([
            'param_name' => 'senderid',
            'param_value' => 'TNSOFT'
        ]);

    }
}

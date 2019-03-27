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
            'url' => 'http://www.smsjust.com/sms/user/urlsms.php?username=techuser&pass=tech@12345&senderid=TNSOFT'
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // $this->call(UsersTableSeeder::class);
      //  $this->call(DocumentTableSeeder::class);
       // $this->call(SettingsTableSeeder::class);
        //$this->call(DepartmentsTableSeeder::class);
        //$this->call(DistrictsTableSeeder::class);
        // $this->call(TalukasTableSeeder::class);
        $this->call(ActionTableSeeder::class);
    }
}

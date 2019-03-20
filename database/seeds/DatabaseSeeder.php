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
        $this->call(UsersTableSeeder::class); // Prod done
        $this->call(DocumentTableSeeder::class); // Prod done
        $this->call(SettingsTableSeeder::class); // Prod done
        $this->call(DepartmentsTableSeeder::class); // Prod done
        $this->call(DistrictsTableSeeder::class); // Prod done
        $this->call(TalukasTableSeeder::class); // Prod done
        $this->call(ActionTableSeeder::class);
    }
}

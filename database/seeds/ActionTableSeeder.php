<?php

use Illuminate\Database\Seeder;

class ActionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Action::create(['user_type' => 'PA_USER','action' => 'Verify']);
        App\Action::create(['user_type' => 'PA_USER','action' => 'Check']);
        App\Action::create(['user_type' => 'CLERK','action' => 'Upload']);
        App\Action::create(['user_type' => 'CLERK','action' => 'Submit']);
        App\Action::create(['user_type' => 'DEPARTMENT_USER','action' => 'Reject']);
        App\Action::create(['user_type' => 'DEPARTMENT_USER','action' => 'Complete']);
    }
}

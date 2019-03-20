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
        App\Document::create(['user_type' => 'PA_USER','action' => 'Verify']);
        App\Document::create(['user_type' => 'PA_USER','action' => 'Check']);
        App\Document::create(['user_type' => 'CLERK','action' => 'Upload']);
        App\Document::create(['user_type' => 'CLERK','action' => 'Submit']);
        App\Document::create(['user_type' => 'DEPARTMENT_USER','action' => 'Reject']);
        App\Document::create(['user_type' => 'DEPARTMENT_USER','action' => 'Complete']);
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('inward_no');
            $table->string('name');
            $table->string('subject');
            $table->string('address')->nullable();
            $table->string('district');
            $table->string('taluka');
            $table->string('mobile');
            $table->string('documents');
            $table->string('status');
            $table->integer('department')->nullable();
            $table->date('date');
            $table->bigInteger('user_id');
            $table->string('reference_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}

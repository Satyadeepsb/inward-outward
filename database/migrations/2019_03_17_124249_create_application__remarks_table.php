<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application__remarks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inward_id');
            $table->integer('user_id');
            $table->string('remark')->nullable();
            $table->string('action');
            $table->string('comment')->nullable();
            $table->string('department');
            $table->integer('officer')->nullable();
            $table->string('role');
            $table->date('deleted')->nullable();
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
        Schema::dropIfExists('application__remarks');
    }
}

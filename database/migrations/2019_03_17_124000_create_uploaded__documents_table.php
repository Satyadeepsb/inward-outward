<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadedDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploaded__documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('original_name');
            $table->string('document_name');
            $table->integer('application_id');
            $table->integer('user_id');
            $table->string('stored_path');
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
        Schema::dropIfExists('uploaded__documents');
    }
}

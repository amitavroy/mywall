<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client_file_name');
            $table->string('mime_type');
            $table->string('file_size', 10);
            $table->string('file_name')->comment('Sanitized file name');
            $table->string('file_path')->comment('The actual url where the file is stored');
            $table->string('type')->comment('Where the file is stored. S3 / Local');
            $table->boolean('status')->default(0)->comment('Whether the file is being used');
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
        Schema::drop('files');
    }
}

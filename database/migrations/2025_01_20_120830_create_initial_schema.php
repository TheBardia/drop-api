<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {

        Schema::create('drops', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id'); // Store UUID without foreign key
            $table->string('name')->nullable();
            $table->timestamps();
        });
        
        

        Schema::create('drop_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('drop_id');
            $table->string('original_name');
            $table->bigInteger('size');
            $table->string('aws_path');
            $table->timestamps();

            $table->foreign('drop_id')->references('id')->on('drops')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('drop_files');
        Schema::dropIfExists('drops');
    }
};

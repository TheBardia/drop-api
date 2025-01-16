<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class RemoveUserIdForeignConstraintFromDropsTable extends Migration
{
    public function up()
    {
        Schema::table('drops', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Remove the foreign key constraint
        });
    }

    public function down()
    {
        Schema::table('drops', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
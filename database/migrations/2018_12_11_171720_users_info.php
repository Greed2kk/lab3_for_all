<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 
        Schema::create('input', function (Blueprint $table) {
            $table->increments('id', 30);
            $table->integer('MaxUsers', 30);
            $table->integer('cureentUsers', 30);
            $table->integer('total_stage', 60);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('input');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class input extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //add table 'input'
         Schema::create('users_info', function (Blueprint $table) {
            $table->increments('id', 10);
            $table->integer('user_id', 30);
            $table->string('name', 40);
            $table->integer('stage', 20);
            $table->integer('opertion', 10);
            $table->integer('que', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //drop table 'input'
        Schema::dropIfExists('users_info');
    }
}

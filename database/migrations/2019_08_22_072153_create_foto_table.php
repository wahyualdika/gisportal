<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('foto', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('layer_id');
          $table->foreign('layer_id')->references('id')->on('layer')->onDelete('cascade');;
          $table->string('path');
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
        Schema::drop('pop_up_layer');
    }
}

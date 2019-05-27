<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePopUpLayer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pop_up_layer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_layer');
            $table->unsignedInteger('layer_id');
            $table->foreign('layer_id')->references('id')->on('layer')->onDelete('cascade');;
            $table->string('nama_layer');
            $table->integer('sub_layer');
            $table->string('fields');
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

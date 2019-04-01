<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->string('type',15);
            $table->string('title',100);
            $table->integer('default_layer');
            $table->string('id_layer');
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
        Schema::drop('layer');
    }
}

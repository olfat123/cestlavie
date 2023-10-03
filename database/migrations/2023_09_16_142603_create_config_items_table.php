<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('rightIcon');
            $table->string('leftIcon');
            $table->string('color');
            $table->string('url');
            $table->bigInteger('config_id')->unsigned()->nullable();
            $table->foreign('config_id')->references('id')->on('configs');
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
        Schema::dropIfExists('config_items');
    }
};

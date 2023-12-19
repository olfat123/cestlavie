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
        Schema::create('weekly_messages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('message');
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->timestamp('sent_at')->nullable();
            $table->integer('order')->default(0);
            $table->string('day_to_send')->nullable();
            $table->integer('hour_to_send')->nullable();
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
        Schema::dropIfExists('weekly_messages');
    }
};

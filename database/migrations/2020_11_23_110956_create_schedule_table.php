<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            $table->integer('home_team_id')->unsigned();
            $table->integer('guest_team_id')->unsigned();
            $table->foreign('home_team_id')->references('id')->on('team');
            $table->foreign('guest_team_id')->references('id')->on('team');
            $table->unsignedTinyInteger('schedule_week')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule');
    }
}

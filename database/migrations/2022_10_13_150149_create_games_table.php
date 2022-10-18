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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->string('timezone');

            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('statuses');

            $table->unsignedBigInteger('league_id');
            $table->foreign('league_id')->references('id')->on('leagues');

            $table->unsignedBigInteger('season_id');
            $table->foreign('season_id')->references('id')->on('seasons');

            $table->unsignedBigInteger('home_team_id');
            $table->foreign('home_team_id')->references('id')->on('teams');

            $table->unsignedBigInteger('away_team_id');
            $table->foreign('away_team_id')->references('id')->on('teams');

            $table->integer('home_quarter_1');
            $table->integer('home_quarter_2');
            $table->integer('home_quarter_3');
            $table->integer('home_quarter_4');
            $table->integer('home_over_time');

            $table->integer('away_quarter_1');
            $table->integer('away_quarter_2');
            $table->integer('away_quarter_3');
            $table->integer('away_quarter_4');
            $table->integer('away_over_time');

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
        Schema::dropIfExists('games');
    }
};

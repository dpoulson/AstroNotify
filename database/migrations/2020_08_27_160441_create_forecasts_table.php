<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForecastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forecasts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('location_id');
            $table->integer('time');
            $table->float('cloud_cover');
            $table->float('precip_prob');
            $table->float('wind_speed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forecasts');
    }
}

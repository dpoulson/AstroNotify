<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
	    $table->foreignId('user_id');
	    $table->foreignId('location_id');
	    $table->integer('wind_speed');
	    $table->float('cloud_cover');
	    $table->integer('days_ahead');
	    $table->integer('min_hours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requirements');
    }
}

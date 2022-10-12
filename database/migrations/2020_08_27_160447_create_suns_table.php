<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suns', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('location_id');
            $table->integer('day');
            $table->integer('sunrise');
            $table->integer('sunset');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suns');
    }
}

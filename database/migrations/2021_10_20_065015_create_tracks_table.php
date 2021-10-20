<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->bigIncrements('track_id');
            $table->bigInteger('album_id')->unsigned();
            $table->string('track_name');
            $table->longText('mp3')->nullable();
            $table->longText('lyrics');
            //////foreign keys
            $table->foreign('artist_id')->references('artist_id')->on("artist");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tracks');
    }
}

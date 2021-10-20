<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTracksToArtistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracks_to_artist', function (Blueprint $table) {
            $table->bigInteger('track_id')->unsigned();
            $table->bigInteger('artist_id')->unsigned();
            //////foreign keys
            $table->foreign('artist_id')->references('artist_id')->on("artist");
            $table->foreign('track_id')->references('track_id')->on("tracks");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tracks_to_artist');
    }
}

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
            $table->bigInteger('artist_id')->unsigned();
            $table->string('track_name');
            $table->longText('mp3')->nullable();
            $table->longText('lyrics');
            $table->foreignId('album_id')->nullable();
            //////foreign keys

            $table->foreign('artist_id')->references('artist_id')->on("artist");
            $table->foreign('album_id')->references('album_id')->on("albums")->nullOnDelete();
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Song extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('song', function (Blueprint $table) {
            $table->bigIncrements('song_id');
            $table->bigInteger('artist_id')->unsigned();
            $table->string('song_name');
            $table->longText('lyrics');
        });
        Schema::table("song",function($table){
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
        //
    }
}

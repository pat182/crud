<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->bigIncrements('album_id');
            $table->bigInteger('artist_id')->unsigned();
            $table->string('album_title')->nullable();
            $table->longText('album_cover')->nullable();
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
        Schema::dropIfExists('albums');
    }
}

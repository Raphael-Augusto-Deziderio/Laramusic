<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAlbunsMusicas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('albuns_musicas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_album')->unsigned();
            $table->foreign('id_album')->references('id')->on('albuns')->onDelete('cascade');
            $table->integer('id_musica')->unsigned();
            $table->foreign('id_musica')->references('id')->on('musicas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('albuns_musicas');
    }
}

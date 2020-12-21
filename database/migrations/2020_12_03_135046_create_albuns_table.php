<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albuns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100);
            $table->integer('id_estilo')->unsigned();
            $table->foreign('id_estilo')->references('id')->on('estilos')->onDelete('cascade');
            $table->string('imagem', 200);
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
        Schema::drop('albuns');
    }
}

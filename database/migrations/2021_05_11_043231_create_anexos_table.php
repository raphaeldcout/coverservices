<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnexosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anexos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo');
            $table->text('arquivo');
            $table->integer('codigo_chamado')->unsigned();

            $table->timestamps();
        });

        Schema::table('anexos', function (Blueprint $table) {

            $table->foreign('codigo_chamado')->references('id')->on('chamados');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anexos');
    }
}

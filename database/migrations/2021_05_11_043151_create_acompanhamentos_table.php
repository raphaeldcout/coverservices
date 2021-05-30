<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcompanhamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acompanhamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('autor')->unsigned();
            $table->integer('codigo_solicitante')->unsigned();
            $table->integer('codigo_atendente')->unsigned();
            $table->integer('codigo_chamado')->unsigned();
            $table->string('titulo');
            $table->text('descricao');

            $table->timestamps();

            
        });

        Schema::table('acompanhamentos', function (Blueprint $table) {

            $table->foreign('autor')->references('id')->on('users');

            $table->foreign('codigo_solicitante')->references('id')->on('users');

            $table->foreign('codigo_atendente')->references('id')->on('users');

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
        Schema::dropIfExists('acompanhamentos');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChamadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chamados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('codigo_solicitante')->unsigned();
            $table->integer('codigo_atendente')->unsigned()->nullable();
            $table->integer('codigo_problema')->unsigned();
            $table->integer('codigo_setor')->unsigned();
            $table->string('titulo');
            $table->text('descricao');
            $table->string('status');
            $table->string('prioridade')->nullable();

            $table->timestamps();

            
        });

        Schema::table('chamados', function (Blueprint $table) {

            $table->foreign('codigo_solicitante')->references('id')->on('users');

            $table->foreign('codigo_atendente')->references('id')->on('users');

            $table->foreign('codigo_problema')->references('id')->on('problemas');

            $table->foreign('codigo_setor')->references('id')->on('setors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chamados');
    }
}

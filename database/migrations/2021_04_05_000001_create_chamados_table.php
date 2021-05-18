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
            $table->integer('codigo_solicitante');
            $table->integer('codigo_atendente')->nullable();
            $table->integer('codigo_problema');
            $table->integer('codigo_setor');
            $table->string('titulo');
            $table->text('descricao');
            $table->string('status');
            $table->integer('prioridade');
            $table->timestamps();

            $table->foreign('codigo_solicitante')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('codigo_atendente')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('codigo_problema')
                ->references('id')->on('problemas')
                ->onDelete('cascade');

            $table->foreign('codigo_setor')
                ->references('id')->on('setors')
                ->onDelete('cascade');
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

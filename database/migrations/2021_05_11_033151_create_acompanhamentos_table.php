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
            $table->foreign('autor')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('codigo_solicitante')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('codigo_atendente')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('codigo_chamado')
                ->references('id')->on('chamados')
                ->onDelete('cascade');
            $table->string('titulo');
            $table->text('descricao');
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
        Schema::dropIfExists('acompanhamentos');
    }
}

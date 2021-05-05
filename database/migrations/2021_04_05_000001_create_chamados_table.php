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
            $table->integer('cod_tecnico_id')->references('id')->on('users');;
            $table->string('titulo');
            $table->integer('status');
            $table->integer('urgencia');
            $table->integer('prioridade');
            $table->string('descricao');
            $table->string('resumo');
            $table->text('anexo');
            $table->timestamps();
            //$table->date('data');
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

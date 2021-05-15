<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('def_categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('apelido')->nullable();
            $table->integer('codigo_setor');
            $table->timestamps();
            
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
        Schema::dropIfExists('def_categorias');
    }
}

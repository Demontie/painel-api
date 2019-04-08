<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupoSalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_salas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('grupo_tela_id');
            $table->foreign('grupo_tela_id')->references('id')->on('grupo_telas');
            $table->unsignedInteger('sala_id');
            $table->foreign('sala_id')->references('id')->on('salas');
            $table->boolean('ativo')->default(true);
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
        Schema::dropIfExists('grupo_salas');
    }
}

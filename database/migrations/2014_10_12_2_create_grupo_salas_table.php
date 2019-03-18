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
            $table->unsignedInteger('id_tela_grupo');
            $table->foreign('id_tela_grupo')->references('id')->on('tela_grupos');
            $table->unsignedInteger('id_sala');
            $table->foreign('id_sala')->references('id')->on('salas');
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

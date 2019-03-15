<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelaSalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tela_salas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_tela');
            $table->foreign('id_tela')->references('id')->on('telas');
            $table->unsignedInteger('sala_id_stg');
            $table->foreign('sala_id_stg')->references('sala_id_stg')->on('salas');
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
        Schema::dropIfExists('tela_salas');
    }
}

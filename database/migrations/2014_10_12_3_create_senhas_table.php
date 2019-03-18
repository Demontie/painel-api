<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSenhasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('senhas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_tipo');
            $table->foreign('id_tipo')->references('id')->on('tipos');
            $table->unsignedInteger('id_tela_grupo');
            $table->foreign('id_tela_grupo')->references('id')->on('tela_grupos');
            $table->integer('numero');
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
        Schema::dropIfExists('senhas');
    }
}

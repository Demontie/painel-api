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
            $table->unsignedInteger('tipo_senha_id')->nullable();
            $table->foreign('tipo_senha_id')->references('id')->on('tipo_senhas');
            $table->unsignedInteger('grupo_sala_id')->nullable();
            $table->foreign('grupo_sala_id')->references('id')->on('grupo_salas');
            $table->unsignedInteger('guiche_id')->nullable();
            $table->foreign('guiche_id')->references('id')->on('guiches');
            $table->integer('numero');
            $table->boolean('ativo')->default(true);
            $table->integer('status')->default(1);
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

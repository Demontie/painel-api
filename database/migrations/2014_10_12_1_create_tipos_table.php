<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos', function (Blueprint $table) {
            $table->increments('id');
            $table->char('prefixo');
            $table->string('cor',50)->default('primary darken-4');
            $table->integer('tamanho_fonte')->default(1);
            $table->unsignedInteger('tela_grupo_id');
            $table->foreign('tela_grupo_id')->references('id')->on('tela_grupos');
            $table->integer('ordem');
            $table->string('descricao', 100);
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
        Schema::dropIfExists('tipos');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoSenhasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_senhas', function (Blueprint $table) {
            $table->increments('id');
            $table->char('prefixo');
            $table->string('cor',50)->default('primary darken-4');
            $table->float('tamanho_fonte',2,1)->default(1.5);
            $table->unsignedInteger('grupo_tela_id');
            $table->foreign('grupo_tela_id')->references('id')->on('grupo_telas');
            $table->integer('tamanho_botao')->default(3);
            $table->integer('ordem');
            $table->string('descricao', 100);
            $table->boolean('ativo')->default(true);
            $table->integer('regra_chamada')->default(1);
            $table->boolean('prioridade')->default(false);
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

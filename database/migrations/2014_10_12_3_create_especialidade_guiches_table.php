<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspecialidadeGuichesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especialidade_guiches', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('guiche_id')->nullable();
            $table->foreign('guiche_id')->references('id')->on('guiches');
            $table->unsignedInteger('especialidades_id')->nullable();
            $table->foreign('especialidades_id')->references('id')->on('guiches');
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
        Schema::dropIfExists('especialidade__guiches');
    }
}

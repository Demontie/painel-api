<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuichesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guiches', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('grupo_tela_id');
            $table->foreign('grupo_tela_id')->references('id')->on('grupo_telas');
            $table->integer('user_id')->nullable();
            $table->string('descricao',150);
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
        Schema::dropIfExists('guiches');
    }
}

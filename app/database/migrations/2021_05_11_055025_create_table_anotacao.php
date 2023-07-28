<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAnotacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t026_contrato_anotacoes', function (Blueprint $table) {
            $table->bigIncrements('a026_id_anotacao');
            $table->integer('a013_id_contrato');
            $table->integer('a001_id_usuario');
            $table->string('a026_anotacao_titulo');
            $table->string('a026_nome_usuario');
            $table->text('a026_anotacao_descricao');
            $table->text('a026_anotacao_obs')->nullable();
            $table->boolean('a026_anotacao_aceite')->nullable();
            $table->integer('a028_id_contrato_financeiro')->nullable();
            $table->timestamps();
        });

        Schema::table('t026_contrato_anotacoes', function (Blueprint $table) {
            $table->foreign('a013_id_contrato')->references('a013_id_contrato')->on('t013_contrato');
            $table->foreign('a001_id_usuario')->references('a001_id_usuario')->on('t001_usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t026_contrato_anotacoes');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableT027ContratoPendencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t027_contrato_pendencias', function (Blueprint $table) {
            $table->bigIncrements('a027_id_pendencia');
            $table->integer('a013_id_contrato');
            $table->integer('a001_id_usuario');
            $table->integer('a005_id_empresa');
            $table->string('a027_pendencia');
            $table->string('a027_nome_usuario');
            $table->boolean('a027_pendencia_aceite')->nullable();
            $table->timestamps();
        });

        Schema::table('t027_contrato_pendencias', function (Blueprint $table) {
            $table->foreign('a013_id_contrato')->references('a013_id_contrato')->on('t013_contrato');
            $table->foreign('a001_id_usuario')->references('a001_id_usuario')->on('t001_usuario');
            $table->foreign('a005_id_empresa')->references('a005_id_empresa')->on('t005_empresa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t027_contrato_pendencias');
    }
}

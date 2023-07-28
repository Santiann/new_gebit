<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableT028ContratoFinanceiro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t028_contrato_financeiro', function (Blueprint $table) {
            $table->bigIncrements('a028_id_contrato_financeiro');
            $table->integer('a013_id_contrato');
            $table->integer('a005_id_empresa');
            $table->decimal('a028_valor_fracao', $precision = 15, $scale = 2);
            $table->string('a028_recorrencia', 10)->nullable();
            $table->decimal('a028_valor_comissao', $precision = 15, $scale = 2)->nullable();
            $table->decimal('a028_valor_extra', $precision = 15, $scale = 2)->nullable();
            $table->decimal('a028_valor_total_contrato', $precision = 15, $scale = 2);
            $table->string('a028_justificativa')->nullable();
            $table->date('a028_data_cobranca')->nullable();
            $table->boolean('a028_status')->nullable();
            $table->timestamps();
        });

        Schema::table('t028_contrato_financeiro', function (Blueprint $table) {
            $table->foreign('a013_id_contrato')->references('a013_id_contrato')->on('t013_contrato');
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
        Schema::dropIfExists('table_t028_contrato_financeiro');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContratoNullableColumnsValorFracao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t013_contrato', function (Blueprint $table) {
            $table->decimal('a013_valor_fracao', $precision = 15, $scale = 2);

            $table->decimal('a013_valor_total_contrato', $precision = 15, $scale = 2)->nullable()->change();
            $table->integer('a013_prazo_recisao')->unsigned()->nullable()->change();
            $table->decimal('a013_custo_recisao_antecipada', $precision = 15, $scale = 2)->nullable()->change();
            $table->string('a013_obs_contrato', 500)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t013_contrato', function (Blueprint $table) {
            $table->dropColumn('a013_valor_fracao');

            $table->decimal('a013_valor_total_contrato', $precision = 15, $scale = 2)->change();
            $table->integer('a013_prazo_recisao')->unsigned()->change();
            $table->decimal('a013_custo_recisao_antecipada', $precision = 15, $scale = 2)->change();
            $table->string('a013_obs_contrato', 500)->change();
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnContratoReferenciaValorExtra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t013_contrato', function (Blueprint $table) {
            $table->text("a013_valor_extra_referencia")->after('a013_valor_extra');
            $table->string("a013_moeda",10)->after('a013_valor_total_contrato');
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
            $table->dropColumn(["a013_valor_extra_referencia",'a013_moeda']);
        });
    }
}

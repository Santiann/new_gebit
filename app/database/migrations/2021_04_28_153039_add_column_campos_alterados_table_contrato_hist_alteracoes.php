<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnCamposAlteradosTableContratoHistAlteracoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t016_contrato_hist_alteracoes', function (Blueprint $table) {
            $table->text('a016_campos_alterados')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t016_contrato_hist_alteracoes', function (Blueprint $table) {
            $table->dropColumn('a016_campos_alterados');
        });
    }
}

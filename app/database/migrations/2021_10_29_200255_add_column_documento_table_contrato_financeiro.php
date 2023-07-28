<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDocumentoTableContratoFinanceiro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t028_contrato_financeiro', function (Blueprint $table) {
            $table->string('a028_documento')->after('a028_data_cobranca')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t028_contrato_financeiro', function (Blueprint $table) {
            $table->dropColumn('a028_documento');
        });
    }
}

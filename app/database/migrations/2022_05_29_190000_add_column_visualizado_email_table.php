<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnVisualizadoEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t997_email', function (Blueprint $table) {
            $table->integer('a028_id_contrato_financeiro')->after('a997_conteudo')->nullable();
            $table->string('a997_email_visualizado')->after('a997_conteudo')->nullable();
            $table->string('a997_IP_visualizado')->after('a997_conteudo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t997_email', function (Blueprint $table) {
            $table->dropColumn('a997_IP_visualizado');
            $table->dropColumn('a028_id_contrato_financeiro');
            $table->dropColumn('a997_email_visualizado');
        });
    }
}

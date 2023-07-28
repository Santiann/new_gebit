<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIdEmpresaCategoriasContrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t024_relacao_categorias_contrato', function (Blueprint $table) {
            $table->integer('a005_id_empresa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t024_relacao_categorias_contrato', function (Blueprint $table) {
            $table->dropColumn('a005_id_empresa');
        });
    }
}

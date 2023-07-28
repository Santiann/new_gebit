<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnA013EmpresaContratante extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t013_contrato', function (Blueprint $table) {
            $table->integer('a013_empresa_contratante');
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
            $table->dropColumn('a013_empresa_contratante');
        });
    }
}

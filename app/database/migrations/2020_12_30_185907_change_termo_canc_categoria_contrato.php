<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTermoCancCategoriaContrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t008_categoria_contrato', function (Blueprint $table) {
            $table->string('a008_termo_cancelamento', 1000)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t008_categoria_contrato', function (Blueprint $table) {
            $table->string('a008_termo_cancelamento', 1000)->change();
        });
    }
}

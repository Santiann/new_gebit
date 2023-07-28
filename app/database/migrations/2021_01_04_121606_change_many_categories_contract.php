<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeManyCategoriesContract extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t024_relacao_categorias_contrato', function (Blueprint $table) {
            $table->integer('a013_id_contrato');
            $table->integer('a008_id_cat_contrato');
        });

        Schema::table('t024_relacao_categorias_contrato', function (Blueprint $table) {
            $table->foreign('a013_id_contrato')->references('a013_id_contrato')->on('t013_contrato');
            $table->foreign('a008_id_cat_contrato')->references('a008_id_cat_contrato')->on('t008_categoria_contrato');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t024_relacao_categorias_contrato');
    }
}

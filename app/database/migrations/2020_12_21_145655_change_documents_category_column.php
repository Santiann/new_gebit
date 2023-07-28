<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDocumentsCategoryColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t014_contrato_documento', function (Blueprint $table) {
            $table->integer('a009_id_cat_contr_doc')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t014_contrato_documento', function (Blueprint $table) {
            $table->integer('a009_id_cat_contr_doc')->change();
        });
    }
}

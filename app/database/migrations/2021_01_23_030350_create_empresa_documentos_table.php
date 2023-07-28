<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t025_empresa_documentos', function (Blueprint $table) {
            $table->bigIncrements('a025_id_documento');
            $table->integer('a005_id_empresa');
            $table->string('a025_documento');
            $table->string('a025_obs')->nullable();
            $table->timestamps();

            $table->foreign('a005_id_empresa')->references('a005_id_empresa')->on('t005_empresa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t025_empresa_documentos');
    }
}

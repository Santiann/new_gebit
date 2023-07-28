<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratoContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t029_contrato_contato', function (Blueprint $table) {
            $table->increments('a029_id_contrato_contato');
            $table->integer('a013_id_contrato');
            $table->string('a029_tipo_contato');
            $table->string('a029_nome');
            $table->string('a029_email')->nullable();
            $table->string('a029_fone')->nullable();
            $table->boolean('a029_status');
            $table->integer('created_at_user');
            $table->integer('updated_at_user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t029_contrato_contato');
    }
}

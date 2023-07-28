<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableT030CamposExclusivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t030_campos_exclusivos', function (Blueprint $table) {
            $table->increments('a030_id_campo');
            $table->string('a030_secao');
            $table->string('a030_identificador');
            $table->string('a030_valor_identificador');
            $table->string('a030_campo');
            $table->string('a030_valor');
            $table->integer('a005_id_empresa');
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
        Schema::dropIfExists('t030_campos_exclusivos');
    }
}

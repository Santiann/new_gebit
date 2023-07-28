<?php namespace Dealix\Planos\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreatePlanosTable extends Migration
{

    public function up()
    {
        Schema::create('dealix_planos_planos', function($table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->timestamps();

            $table->string('nome');
            $table->float('valor_mes');
            $table->integer('espaco_disco');
            $table->integer('trafego');
            $table->integer('emails');
            $table->integer('vendas');
            $table->integer('backup');
            $table->integer('chat_zopim');
            $table->integer('erp_tiny');
            $table->boolean('publicado')->default(true);
            


        });

    }

    public function down()
    {
        Schema::dropIfExists('dealix_planos_planos');
    }

}

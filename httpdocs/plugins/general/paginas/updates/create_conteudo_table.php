<?php namespace General\Paginas\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateConteudoTable extends Migration
{
    public function up()
    {
        Schema::create('general_paginas_conteudo', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->json('valor');
            $table->string('identificador');
            $table->string('pagina');
            $table->string('titulo');

        });

    }

    public function down()
    {
        Schema::dropIfExists('general_paginas_conteudo');
    }
}

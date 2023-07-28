<?php namespace General\Paginas\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreatePaginaTable extends Migration
{
    public function up()
    {
        Schema::create('general_paginas_pagina', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('identificador');
            $table->string('seo_title');
            $table->string('seo_description');

        });

    }

    public function down()
    {
        Schema::dropIfExists('general_paginas_pagina');
    }
}

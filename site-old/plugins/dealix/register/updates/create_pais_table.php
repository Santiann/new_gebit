<?php namespace Dealix\Register\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreatePaisTable extends Migration
{
    public function up()
    {
        Schema::create('dealix_register_pais', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dealix_register_pais');
    }
}

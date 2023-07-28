<?php namespace Dealix\Faqs\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateFaqsTable extends Migration
{

    public function up()
    {
        Schema::create('dealix_faqs_faqs', function($table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->timestamps();
            $table->string('pergunta');
            $table->text('resposta');
            $table->boolean('publicado')->default(true);
            $table->datetime('published_at')->nullable();

        });

    }

    public function down()
    {
        Schema::dropIfExists('dealix_faqs_faqs');
    }

}

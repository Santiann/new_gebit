<?php namespace RainLab\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateRelatedTable extends Migration
{

    public function up()
    {
        Schema::create('rainlab_blog_posts_related', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('post_id')->unsigned();
            $table->integer('related_id')->unsigned();
            $table->primary(['post_id', 'related_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('rainlab_blog_related');
    }

}

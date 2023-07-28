<?php namespace LaminSanneh\FantasticFaq\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateFaqGroupsTable extends Migration
{

    public function up()
    {
        Schema::create('dealix_faq_groups', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('seo_slug');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('dealix_faq_groups');
    }

}

<?php namespace LaminSanneh\FantasticFaq\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateQuestionsTable extends Migration
{

    public function up()
    {
        Schema::create('dealix_faq_questions', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('dealix_faq_groups');
            $table->string('title');
            $table->text('description');
            $table->text('body');
            $table->integer('acessed');
            $table->boolean('publicado');
            $table->string('seo_slug');
            $table->string('seo_title');
            $table->text('seo_description');
            $table->timestamps();
        });

        Schema::create('dealix_faq_questions_related', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('parent_id')->unsigned();
            $table->integer('child_id')->unsigned();
            $table->primary(['parent_id', 'child_id']);

        });
    }

    public function down()
    {
        Schema::drop('dealix_faq_questions');
        Schema::drop('dealix_faq_questions_related');
    }

}

<?php namespace Indikator\News\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class ChangeNameSubscribersTable extends Migration
{
    public function up()
    {
        Schema::table('indikator_news_subscribers', function($table)
        {
            $table->string('name', 100)->nullable()->change();
        });
    }

    public function down()
    {

    }
}

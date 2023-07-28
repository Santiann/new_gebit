<?php namespace Dealix\Planos\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddCreditsPlanos extends Migration
{
    public function up()
    {

        Schema::table('dealix_planos_planos', function($table)
        {
            $table->integer('credits')->nullable()->after('free_trial_days');
        });

    }

    public function down()
    {
        Schema::table('dealix_planos_planos', function($table)
        {
            $table->dropColumn('credits');
        });
    }
}

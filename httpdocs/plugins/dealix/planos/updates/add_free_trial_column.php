<?php namespace Dealix\Planos\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddFreeTrialColumn extends Migration
{
    public function up()
    {
        Schema::table('dealix_planos_planos', function($table)
        {
            $table->integer('free_trial_days')->after('is_monthly')->nullable();
        });
    }

    public function down()
    {
        Schema::table('dealix_planos_planos', function($table)
        {
            $table->dropColumn('free_trial_days');
        });
    }
}

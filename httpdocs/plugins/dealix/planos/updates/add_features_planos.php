<?php namespace Dealix\Planos\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddFeaturesPlanos extends Migration
{
    public function up()
    {

        Schema::table('dealix_planos_planos', function($table)
        {
            $table->text('features')->nullable()->after('valor_mes');
        });

    }

    public function down()
    {
        Schema::table('dealix_planos_planos', function($table)
        {
            $table->dropColumn('features');
        });
    }
}

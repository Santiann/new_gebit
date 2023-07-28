<?php namespace Dealix\Planos\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddPagarmeIdColumn extends Migration
{
    public function up()
    {
        Schema::table('dealix_planos_planos', function($table)
        {
            $table->bigInteger('pagarme_id')->after('features');
        });

    }

    public function down()
    {
        Schema::table('dealix_planos_planos', function($table)
        {
            $table->dropColumn('pagarme_id');
        });
    }
}

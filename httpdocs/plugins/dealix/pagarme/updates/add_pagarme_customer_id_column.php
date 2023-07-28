<?php namespace RainLab\User\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddPagarmeCustomerIdColumn extends Migration
{
    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->integer('pagarme_customer_id')->nullable()->after('permissions');
        });
    }

    public function down()
    {
        Schema::table('users', function($table)
        {
            $table->dropColumn('pagarme_customer_id');
        });
    }
}

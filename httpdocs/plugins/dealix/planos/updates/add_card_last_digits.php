<?php namespace Dealix\Planos\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddCardLastDigits extends Migration
{
    public function up()
    {
        Schema::table('dealix_planos_assinaturas', function($table)
        {
            $table->integer('card_last_digits')->nullable()->after('payment_method');
        });

    }

    public function down()
    {
        Schema::table('dealix_planos_assinaturas', function($table)
        {
            $table->dropColumn('card_last_digits');
        });
    }
}

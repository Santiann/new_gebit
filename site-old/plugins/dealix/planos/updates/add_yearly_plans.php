<?php namespace Dealix\Planos\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddYearlyPlans extends Migration
{
    public function up()
    {

        Schema::table('dealix_planos_planos', function($table)
        {
            $table->dropColumn(['espaco_disco', 'trafego', 'emails', 'vendas', 'backup', 'chat_zopim', 'erp_tiny']);
            $table->renameColumn('valor_mes', 'valor');
            $table->boolean('is_monthly')->after('valor_mes')->default(1);
        });

    }

    public function down()
    {
        Schema::table('dealix_planos_planos', function($table)
        {
            $table->renameColumn('valor', 'valor_mes');
            $table->dropColumn('is_monthly');
        });
    }
}

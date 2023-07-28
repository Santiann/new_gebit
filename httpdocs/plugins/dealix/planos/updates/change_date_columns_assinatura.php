<?php namespace Dealix\Planos\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class ChangeDateColumnsAssinatura extends Migration
{
    public function up()
    {
        Schema::table('dealix_planos_assinaturas', function($table)
        {
            $table->dateTimeTz('current_period_start')->nullable()->change();
            $table->dateTimeTz('current_period_end')->nullable()->change();
            $table->dateTimeTz('date_created')->nullable()->change();
            $table->dateTimeTz('date_updated')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('dealix_planos_assinaturas', function($table)
        {
            $table->dateTimeTz('current_period_start')->change();
            $table->dateTimeTz('current_period_end')->change();
            $table->dateTimeTz('date_created')->change();
            $table->dateTimeTz('date_updated')->change();
        });
    }
}

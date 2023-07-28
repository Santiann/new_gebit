<?php namespace Dealix\Planos\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateAssinaturasTable extends Migration
{
    public function up()
    {
        Schema::create('dealix_planos_assinaturas', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->integer('id');
            $table->integer('customer_id');
            $table->integer('plan_id');
            $table->string('status');
            $table->string('payment_method');
            $table->dateTimeTz('current_period_start');
            $table->dateTimeTz('current_period_end');
            $table->dateTimeTz('date_created');
            $table->dateTimeTz('date_updated');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dealix_planos_assinaturas');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnA013Finalidade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t013_contrato', function (Blueprint $table) {
            $table->string('a013_finalidade', 1024)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t013_contrato', function (Blueprint $table) {
            $table->string('a013_finalidade', 500)->change();
        });
    }
}

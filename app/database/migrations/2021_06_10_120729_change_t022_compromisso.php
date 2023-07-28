<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeT022Compromisso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t022_compromisso', function (Blueprint $table) {
            $table->integer('a005_id_empresa_cli_for')->nullable()->change();
            $table->string('a022_classificacao', 1)->nullable()->change();
            $table->decimal('a022_valor_pagar', $precision = 15, $scale = 2)->nullable()->change();
            $table->integer('a022_uso_vital')->nullable()->change();

            $table->text('a022_categorias')->nullable();
            $table->integer('a022_tipo');
            $table->date('a022_data_inicio')->nullable();
            $table->date('a022_data_fim')->nullable();
            $table->string('a022_recorrencia', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->integer('a005_id_empresa_cli_for')->change();
        $table->string('a022_classificacao', 1)->change();
        $table->decimal('a022_valor_pagar', $precision = 15, $scale = 2)->change();
        $table->integer('a022_uso_vital')->change();

        $table->dropColumn('a022_categorias');
        $table->dropColumn('a022_tipo');
        $table->dropColumn('a022_data_inicio');
        $table->dropColumn('a022_data_fim');
        $table->dropColumn('a022_recorrencia');
    }
}

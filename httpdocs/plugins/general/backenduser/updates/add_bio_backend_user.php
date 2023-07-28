<?php namespace General\BackendUser\Updates;

use October\Rain\Database\Schema\Blueprint;
use Schema;
use October\Rain\Database\Updates\Migration;

class AddBioBackendUser extends Migration
{

    public function up()
    {
        Schema::table('backend_users', function (Blueprint $table) {
            $table->text('bio')->nullable()->after('last_login');
        });
    }

    public function down()
    {
        Schema::table('backend_users', function (Blueprint $table) {
            $table->dropColumn('bio');
        });
    }

}

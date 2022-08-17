<?php namespace RainLab\User\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class RolesAndPermissions extends Migration
{

    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->engine = 'InnoDB';
            $table->string('is_principal')->boolean();
        });
    }

    public function down()
    {
        if (Schema::hasColumn('users', 'is_principal')) {
            Schema::table('users', function($table)
            {
                $table->dropColumn('is_principal');
            });
        }
    }

}

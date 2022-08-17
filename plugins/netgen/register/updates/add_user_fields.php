<?php namespace Netgen\Register\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddNewFields extends Migration
{

    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->engine = 'InnoDB';
            $table->string('fathername')->nullable();
            $table->string('mothername')->nullable();
            $table->string('academicyear')->nullable();
            $table->string('mobile')->nullable();
            $table->string('gender')->nullable();
        });
    }

    public function down()
    {
        if (Schema::hasColumn('users', 'fathername')) {
            Schema::table('users', function($table)
            {
                $table->dropColumn('fathername');
                $table->dropColumn('mothername');
                $table->dropColumn('academicyear');
                $table->dropColumn('mobile');
                $table->dropColumn('gender');
            });
        }
    }

}

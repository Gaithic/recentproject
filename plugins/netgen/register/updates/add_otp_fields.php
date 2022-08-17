<?php namespace Netgen\Register\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddOtpField extends Migration
{

    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->engine = 'InnoDB';
            $table->string('otp')->nullable();
        });
    }

    public function down()
    {
        if (Schema::hasColumn('users', 'otp')) {
            Schema::table('users', function($table)
            {
                $table->dropColumn('otp');
            });
        }
    }
}

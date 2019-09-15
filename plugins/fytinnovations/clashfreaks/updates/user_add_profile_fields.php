<?php namespace RainLab\UserPlus\Updates;
use Schema;
use October\Rain\Database\Updates\Migration;
class UserAddProfileFields extends Migration
{
    public function up()
    {
        if (Schema::hasColumns('users', ['player_tag'])) {
            return;
        }
        Schema::table('users', function($table)
        {
            $table->string('player_tag', 100)->after('name')->nullable();
        });
    }
    public function down()
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function ($table) {
                $table->dropColumn(['player_tag']);
            });
        }
    }
}
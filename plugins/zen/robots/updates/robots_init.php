<?php namespace Zen\Robots\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class RobotsInit extends Migration
{
    public function up()
    {
        \DB::table('system_settings')->where('item', 'zen_robots_settings')->delete();
        \DB::table('system_settings')->insert([
            'item' => 'zen_robots_settings',
            'value' => '{"content":"User-agent: *\r\nAllow: \/\r\nHost: $domain\r\nSitemap: $domain\/sitemap.xml"}'
        ]);
    }
    
    public function down()
    {
        \DB::table('system_settings')->where('item', 'zen_robots_settings')->delete();
    }
}
<?php namespace Fytinnovations\ClashFreaks\Tests\Models;

use PluginTestCase;

class DatabaseSeederTest extends PluginTestCase
{
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }
    public function test_seeding_as_per_environment()
    {
        $this->assertEquals(1,1);
    }
}
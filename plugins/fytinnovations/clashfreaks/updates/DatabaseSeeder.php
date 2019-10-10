<?php namespace Fytinnovations\ClashFreaks\Updates;

use Seeder;
use Eloquent;
use App;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $this->call('Fytinnovations\ClashFreaks\Updates\SeedInitialTables');
        if(App::environment()=="dev"){
            $this->call('Fytinnovations\ClashFreaks\Updates\SeedSampleData');
        }
    }
}

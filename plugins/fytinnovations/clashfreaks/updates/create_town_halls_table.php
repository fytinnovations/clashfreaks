<?php namespace Fytinnovations\ClashFreaks\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateTownHallsTable extends Migration
{
    public function up()
    {
        Schema::create('fytinnovations_clashfreaks_town_halls', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->index();
            $table->integer('village_type_id')->unsigned();
            $table->timestamps();
            $table->foreign('village_type_id','village_type_id')->references('id')->on('fytinnovations_clashfreaks_village_types');
        });
    }

    public function down()
    {
        Schema::table('fytinnovations_clashfreaks_town_halls', function ($table) {
            $table->dropForeign('village_type_id');
        });
        Schema::dropIfExists('fytinnovations_clashfreaks_town_halls');   
    }
}

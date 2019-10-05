<?php namespace Fytinnovations\ClashFreaks\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateVillageTypesTable extends Migration
{
    public function up()
    {
        Schema::create('fytinnovations_clashfreaks_village_types', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fytinnovations_clashfreaks_village_types');
    }
}

<?php namespace Fytinnovations\ClashFreaks\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateBaseDesignsTable extends Migration
{
    public function up()
    {
        Schema::create('fytinnovations_clashfreaks_base_designs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->index();
            $table->text('description');
            $table->string('url');
            $table->boolean('is_active')->default(0);
            $table->timestamps();
            $table->integer('town_hall_id')->unsigned();
            $table->integer('created_by_id')->nullable();
            $table->string('created_by_type')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->string('updated_by_type')->nullable();
            $table->foreign('town_hall_id','town_hall_id')->references('id')->on('fytinnovations_clashfreaks_town_halls');
        });
    }

    public function down()
    {
        Schema::table('fytinnovations_clashfreaks_base_designs', function ($table) {
            $table->dropForeign('town_hall_id');
        });
        Schema::dropIfExists('fytinnovations_clashfreaks_base_designs');
    }
}

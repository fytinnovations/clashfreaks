<?php

namespace Fytinnovations\ClashFreaks\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateBaseRatingsTable extends Migration
{
    public function up()
    {
        Schema::create('fytinnovations_clashfreaks_base_ratings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('base_design_id')->unsigned();
            $table->integer('ratings')->unsigned();
            $table->timestamps();
            $table->foreign('user_id', 'user_id')->references('id')->on('users');
            $table->foreign('base_design_id', 'base_design_id')->references('id')->on('fytinnovations_clashfreaks_base_designs');
        });
    }

    public function down()
    {
        Schema::table('fytinnovations_clashfreaks_base_ratings', function ($table) {
            $table->dropForeign('user_id', 'base_design_id');
        });
        Schema::dropIfExists('fytinnovations_clashfreaks_base_ratings');
    }
}

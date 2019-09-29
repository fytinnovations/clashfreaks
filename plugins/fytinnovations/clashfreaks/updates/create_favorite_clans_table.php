<?php

namespace Fytinnovations\ClashFreaks\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateFavoriteClansTable extends Migration
{
    public function up()
    {
        Schema::create('fytinnovations_clashfreaks_favorite_clans', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('clan_tag');
            $table->foreign('user_id', 'player_user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('fytinnovations_clashfreaks_favorite_clans', function ($table) {
            $table->dropForeign('player_user_id');
        });
        Schema::dropIfExists('fytinnovations_clashfreaks_favorite_clans');
    }
}

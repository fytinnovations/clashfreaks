<?php namespace Fytinnovations\ClashFreaks\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateFavoritePlayersTable extends Migration
{
    public function up()
    {
        Schema::create('fytinnovations_clashfreaks_favorite_players', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('player_tag');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('fytinnovations_clashfreaks_favorite_players', function ($table) {
            $table->dropForeign('fytinnovations_clashfreaks_favorite_players_user_id_foreign');
        });
        Schema::dropIfExists('fytinnovations_clashfreaks_favorite_players');
    }
}

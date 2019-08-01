<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlugListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plug_lists', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('RESTRICT');

            $table->unsignedBigInteger('game_id')->unsigned();
            $table->foreign('game_id')->references('id')->on('games')->onDelete('CASCADE')->onUpdate('RESTRICT');

            $table->unsignedBigInteger('plug_id')->unsigned()->unique();;
            $table->foreign('plug_id')->references('id')->on('plug_shops')->onDelete('CASCADE')->onUpdate('RESTRICT');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plug_lists');
    }
}

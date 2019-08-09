<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlugShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plug_shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuidShort',8)->unique();

            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('RESTRICT');

            $table->unsignedBigInteger('game_id')->unsigned();
            $table->foreign('game_id')->references('id')->on('games')->onDelete('SETNULL')->onUpdate('RESTRICT');

            $table->string('name',32);
            $table->unsignedInteger('price')->nullable();
            $table->string('version',8)->nullable();
            $table->string('description',32)->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('plug_shops');
    }
}

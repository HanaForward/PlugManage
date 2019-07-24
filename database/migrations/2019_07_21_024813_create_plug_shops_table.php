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
            $table->string('name',32);
            $table->unsignedBigInteger('game')->references('games')->on('id');
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

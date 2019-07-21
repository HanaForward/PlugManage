<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('token',16)->unique();
            $table->string('alias',30);
            $table->string('bind',15)->nullable();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('switch')->nullable();
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
        Schema::dropIfExists('tokens');
    }

}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlugStartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plug_starts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('template_uuid',36);
            $table->foreign('template_uuid')->references('template_uuid')->on('templates')->onDelete('CASCADE')->onUpdate('RESTRICT');

            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('RESTRICT');

            $table->unsignedBigInteger('plug')->unsigned();
            $table->foreign('plug')->references('id')->on('plug_lists')->onDelete('CASCADE')->onUpdate('RESTRICT');;

            $table->boolean('switch')->nullable()->default(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plug_starts');
    }
}

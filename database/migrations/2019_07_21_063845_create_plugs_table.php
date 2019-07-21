<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plugs', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('templates')->onDelete('cascade');
            $table->unsignedBigInteger('plug_id')->unsigned();;
            $table->foreign('plug_id')->references('id')->on('plug_shops');
            $table->boolean('switch');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plugs');
    }
}

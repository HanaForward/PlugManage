<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlugStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plug_storages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('plug_id')->unsigned();
            $table->foreign('plug_id')->references('id')->on('plug_shops');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('RESTRICT');
            $table->string('version',9);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        DB::statement("ALTER TABLE plug_storages ADD data MediumBlob AFTER version");
        DB::statement("ALTER TABLE plug_storages ADD UNIQUE KEY(plug_id, version)");
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plug_storages');
    }
}

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
            $table->unsignedBigInteger('plug_id')->unsigned();
            $table->foreign('plug_id')->references('id')->on('plug_shops');
            $table->string('version',9);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        DB::statement("ALTER TABLE plug_storages ADD data MediumBlob AFTER version");
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

<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibrarieStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('librarie_storages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50);
            $table->string('version',9);
            $table->string('publickey',8)->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        DB::statement("ALTER TABLE librarie_storages ADD data MediumBlob AFTER publickey");
        DB::statement("ALTER TABLE librarie_storages ADD UNIQUE KEY( name , version)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('librarie_storages');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->string('id_pelanggan');
        $table->string('address');
        $table->string('name');
        $table->string('tariff');
        $table->string('daya');
        $table->string('no_meter');
        $table->string('merk_meter');
        $table->string('type_meter');
        $table->string('no_comm_device');
        $table->string('merk_comm_device');
        $table->string('type_comm_device');
        $table->string('port');
        $table->string('phone')->unique();
        $table->string('provider');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
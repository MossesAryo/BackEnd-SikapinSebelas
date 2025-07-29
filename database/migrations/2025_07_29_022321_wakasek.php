<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// 2. Wakasek
return new class extends Migration {
    public function up() {
        Schema::create('wakasek', function (Blueprint $table) {
            $table->integer('nip_wakasek')->unique();
            $table->unsignedBigInteger('id_user');
            $table->string('nama_wakasek');

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('wakasek');
    }
};
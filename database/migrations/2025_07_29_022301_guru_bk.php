<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up() {
        Schema::create('guru_bk', function (Blueprint $table) {
            $table->bigInteger('nip_bk')->unique();
            $table->string('username');
            $table->string('nama_guru_bk');
            $table->timestamps();

            $table->foreign('username')->references('username')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('guru_bk');
    }
};

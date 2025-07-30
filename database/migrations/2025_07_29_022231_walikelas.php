<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// 4. WaliKelas
return new class extends Migration {
    public function up() {
        Schema::create('walikelas', function (Blueprint $table) {
            $table->integer('nip_walikelas')->unique();
            $table->string('username');
            $table->string('id_kelas');
            $table->string('nama_walikelas');

            $table->foreign('username')->references('username')->on('users')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('walikelas');
    }
};

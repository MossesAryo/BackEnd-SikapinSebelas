<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// 6. Guru BK
return new class extends Migration {
    public function up() {
        Schema::create('guru_bk', function (Blueprint $table) {
            $table->integer('nip_bk')->unique();
            $table->unsignedBigInteger('id_user');
            $table->string('nama_guru_bk');
            
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('guru_bk');
    }
};

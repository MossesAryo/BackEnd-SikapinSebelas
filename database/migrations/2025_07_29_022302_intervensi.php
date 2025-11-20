<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// 8. Intervensi
return new class extends Migration {
    public function up() {
        Schema::create('intervensi', function (Blueprint $table) {
            $table->integer('id_intervensi')->unique();
            $table->integer('nip_bk');
            $table->integer('nis');
            $table->string('nama_intervensi');
            $table->enum('status', ['Dalam Bimbingan', 'Selesai']);
            $table->date('tanggal');
            $table->timestamps();
            
            $table->foreign('nip_bk')->references('nip_bk')->on('guru_bk')->onDelete('cascade');
            $table->foreign('nis')->references('nis')->on('siswa')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('intervensi');
    }
};

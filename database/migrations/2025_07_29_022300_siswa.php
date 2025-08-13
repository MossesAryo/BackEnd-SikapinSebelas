<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// 7. Siswa
return new class extends Migration {
    public function up() {
        Schema::create('siswa', function (Blueprint $table) {
            $table->integer('nis')->unique();
            $table->string('id_kelas');
    
            $table->string('nama_siswa');
            $table->integer('poin_apresiasi');
            $table->integer('poin_pelanggaran');
            $table->integer('poin_total');
            $table->timestamps();


            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
                       
        });
    }
    public function down() {
        Schema::dropIfExists('siswa');
    }
};


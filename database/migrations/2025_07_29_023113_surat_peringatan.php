<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// 11. Surat Peringatan
return new class extends Migration {
    public function up() {
        Schema::create('surat_peringatan', function (Blueprint $table) {
            $table->integer('id_sp')->unique();
            $table->integer('nis');
            $table->date('tanggal_sp');
            $table->enum('level_sp', ['SP1', 'SP2', 'SP3']);
            $table->string('alasan');
            $table->timestamps();

            $table->foreign('nis')->references('nis')->on('siswa')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('surat_peringatan');
    }
};
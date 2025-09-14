<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// 8. Intervensi
return new class extends Migration {
    public function up()
    {
        Schema::create('intervensi', function (Blueprint $table) {
            $table->integer('id_intervensi')->unique();
            $table->integer('nip_bk')->nullable();
            $table->integer('nis');
            $table->string('nama_intervensi');
            $table->enum('status', ['Dalam Bimbingan', 'Dalam Pemantauan', 'Selesai']);
            $table->string('Perubahan Setelah Intervensi')->nullable();
            $table->date('tanggal_Mulai_Perbaikan');
            $table->date('tanggal_Selesai_Perbaikan');
            $table->foreign('nip_bk')->references('nip_bk')->on('guru_bk')->onDelete('cascade');
            $table->foreign('nis')->references('nis')->on('siswa')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('intervensi');
    }
};

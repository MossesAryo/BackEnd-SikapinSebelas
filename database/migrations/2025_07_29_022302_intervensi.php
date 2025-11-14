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
            $table->bigInteger('nip_bk')->nullable();
            $table->bigInteger('nip_walikelas')->nullable();
            $table->bigInteger('nip_wakasek')->nullable();
            $table->bigInteger('nis');
            $table->string('nama_intervensi');
            $table->string('isi_intervensi');
            $table->enum('status', ['Dalam Bimbingan', 'Dalam Pemantauan', 'Selesai']);
            $table->string('perubahan_setelah_intervensi')->nullable();
            $table->date('tanggal_Mulai_Perbaikan');
            $table->date('tanggal_Selesai_Perbaikan');
            $table->foreign('nip_bk')->references('nip_bk')->on('guru_bk')->onDelete('cascade');
            $table->foreign('nip_walikelas')->references('nip_walikelas')->on('walikelas')->onDelete('cascade');
            $table->foreign('nip_wakasek')->references('nip_wakasek')->on('wakasek')->onDelete('cascade');
            $table->foreign('nis')->references('nis')->on('siswa')->onDelete('cascade');
            $table->timestamps();
        }); 
    }
    public function down()
    {
        Schema::dropIfExists('intervensi');
    }
};

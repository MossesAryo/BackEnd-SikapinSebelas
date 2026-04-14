<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->bigInteger('nis')->unique();
            $table->string('id_kelas')->nullable();
            $table->string('id_jurusan')->nullable();
            $table->string('nama_siswa');
            $table->enum('status', ['aktif', 'alumni', 'nonaktif'])->default('aktif');
            $table->integer('poin_apresiasi')->nullable();
            $table->integer('poin_pelanggaran')->nullable();
            $table->integer('poin_total')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
            $table->foreign('id_jurusan')->references('id_jurusan')->on('jurusan')->onDelete('cascade')->onUpdate('cascade');

        });
    }
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
};

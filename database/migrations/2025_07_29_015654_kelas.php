<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// 3. Kelas
return new class extends Migration {
    public function up() {
        Schema::create('kelas', function (Blueprint $table) {
            $table->string('id_kelas')->unique();
            $table->string('nama_kelas');
            $table->string('id_jurusan');
            $table->timestamps();

            $table->foreign('id_jurusan')->references('id_jurusan')->on('jurusan')->onDelete('cascade')->onUpdate('cascade');
        });


    
    }
    public function down() {
        Schema::dropIfExists('kelas');
    }
};

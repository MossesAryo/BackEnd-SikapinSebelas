<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// 5. Ketua Program
return new class extends Migration {
    public function up() {
        Schema::create('ketua_program', function (Blueprint $table) {
            $table->integer('nip_kaprog');
            $table->string('username');
            $table->string('nama_ketua_program');
            $table->string('jurusan');
            $table->timestamps();
            
            $table->foreign('username')->references('username')->on('users')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('ketua_program');
    }
};

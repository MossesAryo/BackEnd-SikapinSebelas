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
           
            $table->timestamps();

            
        });


    
    }
    public function down() {
        Schema::dropIfExists('kelas');
    }
};

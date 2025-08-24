<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// 12. Penghargaan
return new class extends Migration {
    public function up() {
        Schema::create('penghargaan', function (Blueprint $table) {
            $table->string('id_penghargaan')->unique();  
            $table->date('tanggal_penghargaan');
            $table->enum('level_penghargaan', ['PH1', 'PH2', 'PH3']);
            $table->string('alasan');
            $table->timestamps();

            
        });
    }
    public function down() {
        Schema::dropIfExists('penghargaan');
    }
};


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// 9. Aspek Penilaian
return new class extends Migration {
    public function up() {
        Schema::create('aspek_penilaian', function (Blueprint $table) {
            $table->integer('id_aspekpenilaian')->unique();
            $table->enum('jenis_poin', ['Pelanggaran', 'Apresiasi']);
            $table->string('kategori');
            $table->string('uraian');
            $table->string('pelanggaran_ke');
            $table->integer('indikator_poin');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('aspek_penilaian');
    }
};

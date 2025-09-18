<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// 10. Penilaian
return new class extends Migration {
    public function up()
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->integer('id_penilaian')->unique()->autoIncrement();
            $table->bigInteger('nip_wakasek')->nullable();
            $table->bigInteger('nip_walikelas')->nullable();
            $table->bigInteger('nip_bk')->nullable();
            $table->string('id_aspekpenilaian');
            $table->bigInteger('nis');
            $table->timestamps();

            $table->foreign('nip_wakasek')->references('nip_wakasek')->on('wakasek')->onDelete('cascade');
            $table->foreign('nip_walikelas')->references('nip_walikelas')->on('walikelas')->onDelete('cascade');
            $table->foreign('nip_bk')->references('nip_bk')->on('guru_bk')->onDelete('cascade');
            $table->foreign('id_aspekpenilaian')->references('id_aspekpenilaian')->on('aspek_penilaian')->onDelete('cascade');
            $table->foreign('nis')->references('nis')->on('siswa')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('penilaian');
    }
};

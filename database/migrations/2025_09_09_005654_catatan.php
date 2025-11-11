<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('catatan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nis');
            $table->bigInteger('nip_wakasek')->nullable();
            $table->bigInteger('nip_walikelas')->nullable();
            $table->string('judul_catatan');
            $table->text('isi_catatan');
            $table->timestamps();

            $table->foreign('nis')->references('nis')->on('siswa')->onDelete('cascade');
            $table->foreign('nip_wakasek')->references('nip_wakasek')->on('wakasek')->onDelete('cascade');
            $table->foreign('nip_walikelas')->references('nip_walikelas')->on('walikelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan');
    }
};

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
        Schema::create('siswaperingatan', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('nis');
            $table->integer('id_sp');
            $table->timestamps();
             $table->foreign('nis')->references('nis')->on('siswa')->onDelete('cascade');
            $table->foreign('id_sp')->references('id_sp')->on('surat_peringatan')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswaperingatan');
    }
};

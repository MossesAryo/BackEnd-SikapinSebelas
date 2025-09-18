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
        Schema::create('siswapenghargaan', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('nis');
            $table->string('id_penghargaan');
            $table->timestamps();
            $table->foreign('nis')->references('nis')->on('siswa')->onDelete('cascade');
            $table->foreign('id_penghargaan')->references('id_penghargaan')->on('penghargaan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswapenghargaan');
    }
};

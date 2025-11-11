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
        Schema::create('guru_bk_kelas', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('guru_bk_id');
            $table->string('kelas_id');
            $table->timestamps();

            $table->foreign('guru_bk_id')->references('nip_bk')->on('guru_bk')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id_kelas')->on('kelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru_bk_kelas');
    }
};

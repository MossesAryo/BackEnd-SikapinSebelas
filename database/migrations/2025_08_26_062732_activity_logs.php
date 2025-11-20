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
        Schema::create('activity_logs', function (Blueprint $table) {            
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->bigInteger('nis')->nullable();
            $table->enum('kategori', ['Apresiasi', 'Pelanggaran']);
            $table->string('activity');
            $table->text('description')->nullable();
            $table->integer('point')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('nis')->references('nis')->on('siswa')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};

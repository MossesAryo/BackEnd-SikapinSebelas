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
        Schema::create('bukti_pembinaan', function (Blueprint $table) {
            $table->bigInteger('id_bukti_pembinaan')->unique()->autoIncrement(1);
            $table->integer('intervensi_id')->nullable();
            $table->string('file');
            $table->timestamps();
            $table->foreign('intervensi_id')->references('id_intervensi')->on('intervensi')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukti_pembinaan');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bukti_pembinaan', function (Blueprint $table) {
            $table->string('nama_file')->nullable()->after('file');
        });
    }

    public function down(): void
    {
        Schema::table('bukti_pembinaan', function (Blueprint $table) {
            $table->dropColumn('nama_file');
        });
    }
};
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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('nis'); // Kolom untuk NIS siswa
            $table->string('pelanggaran'); // Kolom untuk pelanggaran yang dilakukan
            $table->date('tanggal'); // Kolom untuk tanggal pelanggaran
            $table->string('bukti')->nullable(); // Kolom untuk menyimpan bukti (file), bisa nullable
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};

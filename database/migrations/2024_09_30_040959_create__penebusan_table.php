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
        Schema::create('_penebusan', function (Blueprint $table) {
            $table->id(); 
            $table->string('nis');
            $table->string('nama');
            $table->string('nama_Prestasi');
            $table->date('tanggal');
            $table->string('point');
            $table->string('bukti')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_penebusan');
    }
};

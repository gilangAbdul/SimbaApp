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
        Schema::create('riwayat_permintaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nip_pemohon');
            $table->string('fname_ttd_pemohon');
            $table->foreignId('status_persetujuan_id');
            $table->foreignId('nip_penyetuju')->nullable();
            $table->foreignId('nip_petugas')->nullable();
            $table->string('fname_ttd_petugas')->nullable();
            $table->string('filename_laporan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_permintaans');
    }
};

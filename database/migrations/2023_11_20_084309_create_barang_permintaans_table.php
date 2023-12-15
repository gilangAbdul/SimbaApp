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
        Schema::create('barang_permintaans', function (Blueprint $table) {
            $table->foreignId('riwayat_permintaan_id');
            $table->foreignId('master_barang_id');
            $table->integer('stok_request');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_permintaans');
    }
};

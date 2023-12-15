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
        Schema::create('riwayat_masuk_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nip_petugas');
            $table->string('platform_beli', 100);
            $table->string('fname_nota', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_masuk_barangs');
    }
};

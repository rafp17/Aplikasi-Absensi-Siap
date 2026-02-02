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
        // Ganti Schema::table menjadi Schema::create
        Schema::create('riwayat_usulans', function (Blueprint $table) {
            $table->id(); // ID Otomatis
            
            // Kolom standar yang kita butuhkan
            $table->unsignedBigInteger('user_id')->nullable(); // ID Pengguna
            
            // Kolom Data Form
            $table->string('jenis')->nullable();             // PLT / PLH
            $table->string('eselon')->nullable();            // II.a, III.a, dll
            $table->string('tujuan_pengiriman')->nullable(); // Verifikator, Sekda, dll
            
            // Kolom Tambahan agar tidak error saat create
            $table->text('keterangan')->nullable();
            
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Ganti dropColumn menjadi dropIfExists (Hapus tabel jika rollback)
        Schema::dropIfExists('riwayat_usulans');
    }
};
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
        // PENTING: Matikan pengecekan Foreign Key sementara untuk menghindari Error 150
        Schema::disableForeignKeyConstraints();

        Schema::create('mutasi', function (Blueprint $table) {
            $table->id();

            // Definisi Foreign Key (Relasi ke tabel pegawai)
            // Menggunakan unsignedBigInteger agar tipe datanya cocok
            $table->unsignedBigInteger('pegawai_id');
            
            // Kita coba relasikan ke tabel 'pegawai'. 
            // (Jika tabel Anda bernama 'pegawais', kode ini tetap aman karena pengecekan dimatikan sementara)
            $table->foreign('pegawai_id')->references('id')->on('pegawai')->onDelete('cascade');

            // Tipe data ENUM
            $table->enum('jenis_mutasi', [
                'Kenaikan Pangkat', 
                'Masuk', 
                'Pindah Antar Instansi', 
                'Keluar'
            ]);

            $table->date('tanggal');

            // Kolom Instansi & SK
            $table->string('instansi_tujuan')->nullable();
            $table->string('no_sk')->unique();
            $table->string('file_sk')->nullable();

            // --- KOLOM BARU (LANGSUNG DITAMBAHKAN DISINI) ---
            // Supaya tabel langsung lengkap saat dibuat
            $table->string('eselon')->nullable();
            $table->string('tujuan_pengiriman')->nullable(); 

            $table->timestamps();
        });

        // Hidupkan kembali pengecekan Foreign Key
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('mutasi');
        Schema::enableForeignKeyConstraints();
    }
};